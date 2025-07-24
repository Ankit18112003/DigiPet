<x-app-layout>
    <style>
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', system-ui, sans-serif;
            background-image: url('/images/dgp_logo_bg.png');
            background-repeat: no-repeat;
            background-position: center;
            background-size: 65%;
            background-attachment: fixed;
            background-blend-mode: overlay;
            background-color: rgba(248, 250, 252, 0.85);
            color: #1e293b;
        }
        .dashboard-content {
            padding: 2rem;
            max-width: 1800px;
            margin: 0 auto;
        }
        .section-header {
            background-color: rgba(6, 95, 70, 0.75);
            color: #fff;
            padding: 3rem 2rem;
            border-radius: 0.75rem;
            margin-bottom: 2rem;
            position: relative;
            z-index: 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .section-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }
        .section-header p {
            font-size: 1.2rem;
            max-width: 700px;
            font-weight: 500;
        }
        .section-header strong { color: #facc15; }

        .pets-section {
            background-color: rgba(255, 255, 255, 0.4);
            border-radius: 0.75rem;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .pets-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 1.25rem;
            justify-content: space-between;
        }

        .pet-card {
            background-color: rgba(255, 255, 255, 0.6);
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 1.25rem;
            flex: 1 1 calc(33.33% - 1rem);
            display: flex;
            flex-direction: column;
            min-width: 280px;
            position: relative;
        }

        .pet-card:hover { transform: translateY(-4px); }

        .pet-avatar {
            width: 4rem;
            height: 4rem;
            background: #facc15;
            color: #065f46;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            font-size: 2rem;
        }

        .pdf-icon {
            position: absolute;
            top: 10px;
            right: 12px;
            color: #dc2626;
        }

        .pet-header {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .pet-name {
            font-weight: 600;
            font-size: 1.2rem;
            color: #065f46;
        }

        .pet-meta {
            font-size: 0.9rem;
            color: #64748b;
        }

        .pet-details {
            background: #f0fdf4;
            padding: 0.75rem;
            border-radius: 0.5rem;
            margin-top: 1rem;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 0.375rem 0;
            font-size: 0.875rem;
            border-bottom: 1px solid rgba(5, 150, 105, 0.1);
        }

        .detail-label {
            font-weight: 500;
            color: #047857;
        }

        .pet-footer {
            margin-top: 1rem;
            font-size: 0.75rem;
            text-align: center;
            color: #64748b;
        }

        /* Chatbot */
        #chatBox {
            height: 15rem;
            overflow-y: auto;
            border: 1px solid #e5e7eb;
            padding: 0.75rem;
            border-radius: 0.5rem;
            background-color: #f9fafb;
            font-size: 0.875rem;
            margin-bottom: 0.75rem;
        }

        #restartBtn {
            margin-top: 0.5rem;
            width: 100%;
            background-color: #facc15;
            color: #1e293b;
            font-weight: 600;
            padding: 0.4rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
        }

        .symptom-pill {
            background: #f0fdf4;
            border: 1px solid #d1fae5;
            color: #065f46;
            padding: 0.3rem 0.6rem;
            border-radius: 9999px;
            font-size: 0.8rem;
            margin: 0.2rem;
            display: inline-block;
        }
    </style>

    <div class="dashboard-content">
        <div class="section-header">
            <h1>Welcome, {{ Auth::user()->name }}!</h1>
            <p>
                Effortlessly manage and monitor your pets with <strong>DigiPet</strong> — your smart solution for <strong>health records</strong>, <strong>vaccination tracking</strong>, and more.
            </p>
        </div>

        <div class="pets-section">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Your Pets</h2>
            </div>

            @if(isset($pets) && $pets->isEmpty())
                <p>No pets registered yet.</p>
            @elseif(isset($pets))
                <div class="pets-grid">
                    @foreach($pets as $pet)
                        <div class="pet-card">
                            <a href="{{ route('pdf.download', $pet->id) }}" class="pdf-icon" title="Download Pet PDF">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                            <div class="pet-header">
                                <div class="pet-avatar">🐾</div>
                                <div>
                                    <div class="pet-name">{{ $pet->name }}</div>
                                    <div class="pet-meta">{{ ucfirst($pet->type) }} • {{ $pet->breed }}</div>
                                </div>
                            </div>
                            <div class="pet-details">
                                <div class="detail-row"><span class="detail-label">Age</span><span>{{ $pet->age }} yrs</span></div>
                                <div class="detail-row"><span class="detail-label">Color</span><span>{{ ucfirst($pet->color) }}</span></div>
                                <div class="detail-row"><span class="detail-label">Birth Date</span><span>{{ \Carbon\Carbon::parse($pet->dob)->format('M j, Y') }}</span></div>
                                <div class="detail-row"><span class="detail-label">Microchip</span><span>{{ $pet->microchip_number ?: 'Not registered' }}</span></div>
                            </div>
                            <div class="pet-footer">
                                Registered {{ $pet->created_at->diffForHumans() }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Floating Chat Button -->
        <button onclick="document.getElementById('chatModal').classList.remove('hidden')"
            class="fixed bottom-6 right-6 bg-yellow-400 text-black px-4 py-2 rounded-full shadow-lg hover:bg-yellow-300 transition z-50">
            🐾 Pet Doctor
        </button>
    </div>

    <!-- Chat Modal -->
    <div id="chatModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-4 relative">
            <div class="flex justify-between items-center border-b pb-2">
                <h2 class="text-lg font-semibold text-green-800">AI Pet Disease Assistant</h2>
                <button onclick="document.getElementById('chatModal').classList.add('hidden')" class="text-gray-500 hover:text-red-600 text-xl font-bold">&times;</button>
            </div>

            <div id="chatBox" class="mt-4">
                <div class="text-left text-gray-800 mb-2"><strong>VetBot:</strong> 👋 Hi, I'm VetBot! Let’s start your pet's check-up.</div>
                <div class="text-left text-gray-800 mb-2"><strong>VetBot:</strong> What type of animal is it — a dog or a cat?</div>
            </div>

            <form id="chatForm" class="mt-2 flex">
                <input type="text" id="userMessage" name="message" placeholder="Describe your pet’s symptoms..."
                    class="flex-1 border rounded px-2 py-1 text-sm" required>
                <button type="submit" class="ml-2 px-3 py-1 bg-green-600 text-white rounded hover:bg-green-500 text-sm">Send</button>
            </form>

            <button id="restartBtn" onclick="restartChat()">🔄 Restart AI Assistant</button>

            <div class="mt-4">
                <p class="text-xs font-semibold text-gray-600 mb-1">Possible symptoms I understand:</p>
                <div class="flex flex-wrap">
                    @php
                        $rules = config('DiseaseRules') ?? [];
                        $symptomSet = [];
                        foreach ($rules as $species) {
                            foreach ($species as $d) {
                                $symptomSet = array_merge($symptomSet, $d['symptoms']);
                            }
                        }
                        $uniqueSymptoms = array_unique($symptomSet);
                        sort($uniqueSymptoms);
                    @endphp
                    @foreach ($uniqueSymptoms as $symptom)
                        <div class="symptom-pill">
                            {{ str_replace('_',' ', ucfirst($symptom)) }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        const chatBox = document.getElementById('chatBox');
        const chatForm = document.getElementById('chatForm');
        const userInput = document.getElementById('userMessage');

        let step = 0;
        const userData = { animal: '', breed: '', symptoms: '', days: '', extra: '' };

        window.addEventListener('DOMContentLoaded', () => {
            chatBox.scrollTop = chatBox.scrollHeight;
        });

        chatForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            const message = userInput.value.trim();
            if (!message) return;

            addUserMessage(message);
            userInput.value = '';

            switch (step) {
                case 0: userData.animal = message.toLowerCase(); addBotMessage("Breed of your " + userData.animal + "?"); break;
                case 1: userData.breed = message; addBotMessage("What symptoms have you noticed?"); break;
                case 2: userData.symptoms = message; addBotMessage("How many days has this been happening?"); break;
                case 3: userData.days = message; addBotMessage("Any additional behavior changes?"); break;
                case 4:
                    userData.extra = message;
                    addBotMessage("🧠 Analyzing...");
                    const res = await fetch("/chatbot/message", {
                        method: "POST",
                        headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": '{{ csrf_token() }}' },
                        body: JSON.stringify(userData)
                    });
                    const data = await res.json();
                    addBotMessage((data.urgency === 'high' ? "🚨 " : "✅ ") + data.reply);
                    return;
            }
            step++;
        });

        function addUserMessage(msg) {
            chatBox.innerHTML += `<div class="text-right text-black mb-2"><strong>You:</strong> ${msg}</div>`;
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function addBotMessage(msg) {
            const formattedMsg = msg.replace(/\n/g, "<br>");
            const botMsg = document.createElement('div');
            botMsg.className = "text-left text-gray-800 mb-2";
            botMsg.innerHTML = `<strong>VetBot:</strong> ${formattedMsg}`;
            chatBox.appendChild(botMsg);
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function restartChat() {
            chatBox.innerHTML = `
                <div class="text-left text-gray-800 mb-2"><strong>VetBot:</strong> 👋 Hi, I'm VetBot! Let’s start your pet's check-up.</div>
                <div class="text-left text-gray-800 mb-2"><strong>VetBot:</strong> What type of animal is it — a dog or a cat?</div>
            `;
            step = 0;
            Object.keys(userData).forEach(k => userData[k] = '');
        }
    </script>
</x-app-layout>
