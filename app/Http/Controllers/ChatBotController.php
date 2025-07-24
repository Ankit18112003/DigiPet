<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function message(Request $request)
    {
        $animal = strtolower(trim($request->input('animal')));
        $userSymptoms = explode(',', strtolower(trim($request->input('symptoms'))));
        $userSymptoms = array_map('trim', $userSymptoms);

        $diseaseData = config('DiseaseRules');
        $diseases = $diseaseData[$animal] ?? [];

        if (!$diseases || empty($userSymptoms)) {
            return response()->json([
                'reply' => "⚠️ I couldn't process your input. Please ensure you're selecting a valid animal type and listing common symptoms.",
                'urgency' => 'low'
            ]);
        }

        $matches = [];

        foreach ($diseases as $entry) {
            $diseaseSymptoms = array_map('strtolower', $entry['symptoms']);
            $matchedSymptoms = array_intersect($userSymptoms, $diseaseSymptoms);

            if (count($matchedSymptoms) > 0) {
                $matchPercent = round((count($matchedSymptoms) / count($diseaseSymptoms)) * 100);

                $matches[] = [
                    'name' => $entry['disease'],
                    'match_percent' => $matchPercent,
                    'matched' => $matchedSymptoms,
                    'all_symptoms' => $diseaseSymptoms,
                    'urgency' => $entry['urgency'],
                    'treatment' => $entry['treatment'],
                ];
            }
        }

        if (empty($matches)) {
            return response()->json([
                'reply' => "😕 Sorry, I couldn’t find a matching disease for your symptoms. Please consult a vet or try describing the symptoms differently.",
                'urgency' => 'low'
            ]);
        }

        // Get the highest match %
        $maxMatch = collect($matches)->max('match_percent');

        // Define minimum strong match threshold
        $strongThreshold = 40;

        // Filter diseases with highest match
        $topMatches = array_filter($matches, fn($m) => $m['match_percent'] === $maxMatch && $maxMatch >= $strongThreshold);

        // Fallback mode if no strong matches
        if (empty($topMatches)) {
            $fallback = collect($matches)->sortByDesc('match_percent')->take(1)->first();

            $response = "🩺 I couldn’t find a strong match, but based on your symptoms, here’s the closest possible condition:\n\n";
            $response .= "🦠 <strong>{$fallback['name']}</strong>\n";
            $response .= "- Match: {$fallback['match_percent']}%\n";
            $response .= "- Matched Symptoms: " . implode(', ', $fallback['matched']) . "\n";
            $response .= "- Urgency: <em>{$fallback['urgency']}</em>\n";
            $response .= "- Treatment: {$fallback['treatment']}\n";
            $response .= "\n⚠️ It’s best to visit a vet for accurate diagnosis.";

            return response()->json([
                'reply' => nl2br($response),
                'urgency' => $fallback['urgency']
            ]);
        }

        // Determine overall urgency
        $overallUrgency = collect($topMatches)->pluck('urgency')->contains('high') ? 'high' : 'medium';

        // Build reply
        $response = "🧪 Based on your input, the most likely condition(s):\n\n";

        foreach ($topMatches as $match) {
            $response .= "🦠 <strong>{$match['name']}</strong>\n";
            $response .= "- Match: {$match['match_percent']}%\n";
            $response .= "- Matched Symptoms: " . implode(', ', $match['matched']) . "\n";
            $response .= "- Urgency: <em>{$match['urgency']}</em>\n";
            $response .= "- Treatment: {$match['treatment']}\n\n";
        }

        return response()->json([
            'reply' => nl2br($response),
            'urgency' => $overallUrgency
        ]);
    }
}
