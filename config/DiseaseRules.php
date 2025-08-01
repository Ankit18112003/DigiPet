<?php

return [
    'cat' => [
        [
            'symptoms' => ['vomiting', 'lethargy', 'diarrhea', 'appetite_loss'],
            'disease' => 'Panleukopenia',
            'urgency' => 'high',
            'treatment' => 'Supportive care, IV fluids, and hospitalization.',
        ],
        [
            'symptoms' => ['sneezing', 'nasal_discharge', 'eye_discharge', 'coughing'],
            'disease' => 'Upper Respiratory Infection',
            'urgency' => 'medium',
            'treatment' => 'Rest, hydration, and vet evaluation.',
        ],
        [
            'symptoms' => ['appetite_loss', 'skin_lesions', 'lethargy'],
            'disease' => 'Fungal Infection',
            'urgency' => 'medium',
            'treatment' => 'Antifungal meds under veterinary supervision.',
        ],
        [
            'symptoms' => ['eye_discharge', 'sneezing', 'nasal_discharge'],
            'disease' => 'Feline Herpesvirus',
            'urgency' => 'high',
            'treatment' => 'Antiviral medication and supportive care.',
        ],
        [
            'symptoms' => ['vomiting', 'diarrhea', 'appetite_loss'],
            'disease' => 'Intestinal Parasites',
            'urgency' => 'high',
            'treatment' => 'Deworming and hydration treatment.',
        ],
        [
            'symptoms' => ['lethargy', 'eye_discharge', 'appetite_loss', 'nasal_discharge'],
            'disease' => 'Feline Upper Respiratory Infection',
            'urgency' => 'medium',
            'treatment' => 'Antibiotics if bacterial. Supportive care and hydration.',
        ],
        [
            'symptoms' => ['skin_lesions', 'vomiting', 'appetite_loss', 'lethargy'],
            'disease' => 'Ringworm',
            'urgency' => 'medium',
            'treatment' => 'Topical or oral antifungals. Clean infected areas.',
        ],
        [
            'symptoms' => ['eye_discharge', 'nasal_discharge', 'coughing', 'lethargy'],
            'disease' => 'Feline Calicivirus',
            'urgency' => 'high',
            'treatment' => 'Antivirals and vet care. Support respiratory function.',
        ],
        [
            'symptoms' => ['appetite_loss', 'weight_loss', 'vomiting', 'lethargy'],
            'disease' => 'Feline Leukemia',
            'urgency' => 'high',
            'treatment' => 'No cure, but supportive treatments and antivirals may help.',
        ],
        [
            'symptoms' => ['vomiting', 'appetite_loss', 'diarrhea', 'skin_lesions'],
            'disease' => 'Feline Infectious Peritonitis',
            'urgency' => 'high',
            'treatment' => 'Aggressive supportive care. Fatal if untreated.',
        ],
        [
            'symptoms' => ['eye_discharge', 'appetite_loss', 'nasal_discharge'],
            'disease' => 'Conjunctivitis',
            'urgency' => 'medium',
            'treatment' => 'Clean eyes, antibiotic ointments as prescribed.',
        ],
        [
            'symptoms' => ['diarrhea', 'loss_of_appetite', 'dehydration'],
            'disease' => 'Pancreatitis',
            'urgency' => 'medium',
            'treatment' => 'IV fluids, low-fat diet, enzyme therapy.',
        ],
        [
            'symptoms' => ['vomiting', 'diarrhea', 'weight_loss'],
            'disease' => 'Gastroenteritis',
            'urgency' => 'medium',
            'treatment' => 'Withhold food, slowly reintroduce bland diet.',
        ],
        [
            'symptoms' => ['lethargy', 'weight_loss', 'appetite_loss', 'dehydration'],
            'disease' => 'Feline Renal Disease',
            'urgency' => 'high',
            'treatment' => 'Fluids, renal diet, vet monitoring.',
        ],
        [
            'symptoms' => ['coughing', 'eye_discharge', 'sneezing', 'lethargy'],
            'disease' => 'Feline Viral Rhinotracheitis',
            'urgency' => 'high',
            'treatment' => 'Antivirals, antibiotics, humidified air.',
        ],
        [
            'symptoms' => ['weight_loss', 'diarrhea', 'flatulence'],
            'disease' => 'Giardiasis',
            'urgency' => 'medium',
            'treatment' => 'Antiparasitic medication and fluid therapy.',
        ],
        [
            'symptoms' => ['jaundice', 'vomiting', 'lethargy'],
            'disease' => 'Hepatic Lipidosis',
            'urgency' => 'high',
            'treatment' => 'Feeding tube, IV fluids, liver support meds.',
        ],
        [
            'symptoms' => ['weight_loss', 'excessive_thirst', 'increased_urination'],
            'disease' => 'Diabetes Mellitus',
            'urgency' => 'medium',
            'treatment' => 'Insulin injections and diet change.',
        ],
        [
            'symptoms' => ['appetite_loss', 'fever', 'lethargy', 'oral_ulcers'],
            'disease' => 'Feline Immunodeficiency Virus (FIV)',
            'urgency' => 'medium',
            'treatment' => 'Supportive care. Monitor for secondary infections.',
        ],
        [
            'symptoms' => ['seizures', 'confusion', 'appetite_loss'],
            'disease' => 'Feline Epilepsy',
            'urgency' => 'medium',
            'treatment' => 'Anti-seizure medications and neurological exam.',
        ],
    ],
    'dog' => [
        [
            'symptoms' => ['vomiting', 'diarrhea', 'lethargy', 'appetite_loss'],
            'disease' => 'Parvovirus',
            'urgency' => 'high',
            'treatment' => 'Immediate vet care, IV fluids, antiviral support.',
        ],
        [
            'symptoms' => ['coughing', 'nasal_discharge', 'fever'],
            'disease' => 'Canine Distemper',
            'urgency' => 'high',
            'treatment' => 'Supportive treatment, antibiotics for secondary infections.',
        ],
        [
            'symptoms' => ['vomiting', 'diarrhea', 'loss_of_appetite'],
            'disease' => 'Gastroenteritis',
            'urgency' => 'medium',
            'treatment' => 'Hydration and dietary support.',
        ],
        [
            'symptoms' => ['coughing', 'labored_breathing', 'fever'],
            'disease' => 'Canine Influenza',
            'urgency' => 'medium',
            'treatment' => 'Rest and fluids, vet if persistent.',
        ],
        [
            'symptoms' => ['lethargy', 'vomiting', 'loss_of_appetite', 'fever'],
            'disease' => 'Leptospirosis',
            'urgency' => 'high',
            'treatment' => 'Antibiotics and isolation. Immediate vet attention.',
        ],
        [
            'symptoms' => ['sneezing', 'nasal_discharge', 'coughing'],
            'disease' => 'Canine Infectious Tracheobronchitis (Kennel Cough)',
            'urgency' => 'medium',
            'treatment' => 'Usually self-limiting. Use cough suppressants if needed.',
        ],
        [
            'symptoms' => ['fever', 'vomiting', 'appetite_loss'],
            'disease' => 'Canine Coronavirus',
            'urgency' => 'medium',
            'treatment' => 'Supportive care. Hydration and electrolytes.',
        ],
        [
            'symptoms' => ['vomiting', 'diarrhea', 'weight_loss'],
            'disease' => 'Worm Infestation',
            'urgency' => 'medium',
            'treatment' => 'Deworming medication from vet.',
        ],
        [
            'symptoms' => ['fever', 'coughing', 'labored_breathing'],
            'disease' => 'Pneumonia',
            'urgency' => 'high',
            'treatment' => 'Antibiotics and oxygen therapy in severe cases.',
        ],
        [
            'symptoms' => ['excessive_scratching', 'skin_lesions', 'hair_loss'],
            'disease' => 'Mange',
            'urgency' => 'medium',
            'treatment' => 'Medicated baths, topical creams, ivermectin.',
        ],
        [
            'symptoms' => ['aggression', 'paralysis', 'excess_saliva'],
            'disease' => 'Rabies',
            'urgency' => 'high',
            'treatment' => 'No cure. Immediate vet and authority alert.',
        ],
        [
            'symptoms' => ['vomiting', 'diarrhea', 'bloody_stool'],
            'disease' => 'Hemorrhagic Gastroenteritis (HGE)',
            'urgency' => 'high',
            'treatment' => 'Rapid IV fluids, antibiotics. Vet care crucial.',
        ],
        [
            'symptoms' => ['fever', 'nose_bleed', 'muscle_pain'],
            'disease' => 'Ehrlichiosis',
            'urgency' => 'medium',
            'treatment' => 'Doxycycline and vet supervision.',
        ],
        [
            'symptoms' => ['joint_swelling', 'limping', 'fever'],
            'disease' => 'Lyme Disease',
            'urgency' => 'medium',
            'treatment' => 'Antibiotics. Tick prevention ongoing.',
        ],
        [
            'symptoms' => ['seizures', 'behavior_changes', 'confusion'],
            'disease' => 'Canine Epilepsy',
            'urgency' => 'medium',
            'treatment' => 'Anti-seizure meds. Neurological assessment.',
        ],
        [
            'symptoms' => ['joint_pain', 'lethargy', 'fever'],
            'disease' => 'Anaplasmosis',
            'urgency' => 'medium',
            'treatment' => 'Antibiotics like doxycycline.',
        ],
        [
            'symptoms' => ['weight_loss', 'lethargy', 'vomiting'],
            'disease' => 'Cushings Disease',
            'urgency' => 'medium',
            'treatment' => 'Hormonal therapy and medication.',
        ],
        [
            'symptoms' => ['appetite_loss', 'vomiting', 'bloody_diarrhea'],
            'disease' => 'Canine Parvoviral Enteritis',
            'urgency' => 'high',
            'treatment' => 'Isolation, IV fluids, aggressive supportive therapy.',
        ],
        [
            'symptoms' => ['lethargy', 'coughing', 'nasal_discharge'],
            'disease' => 'Heartworm Disease',
            'urgency' => 'high',
            'treatment' => 'Immiticide injections and restricted activity.',
        ],
        [
            'symptoms' => ['itching', 'skin_rash', 'hair_loss'],
            'disease' => 'Canine Allergies',
            'urgency' => 'low',
            'treatment' => 'Antihistamines and allergen avoidance.',
        ],
        [
            'symptoms' => ['ear_discharge', 'head_shaking', 'itching'],
            'disease' => 'Ear Infection',
            'urgency' => 'medium',
            'treatment' => 'Ear cleaning and antibiotic drops.',
        ],
        [
            'symptoms' => ['increased_thirst', 'frequent_urination', 'weight_loss'],
            'disease' => 'Diabetes Mellitus',
            'urgency' => 'medium',
            'treatment' => 'Insulin therapy and diet control.',
        ],
        [
            'symptoms' => ['limping', 'joint_swelling', 'stiffness'],
            'disease' => 'Osteoarthritis',
            'urgency' => 'low',
            'treatment' => 'Pain relievers and joint supplements.',
        ],
        [
            'symptoms' => ['weight_gain', 'lethargy', 'hair_loss'],
            'disease' => 'Hypothyroidism',
            'urgency' => 'medium',
            'treatment' => 'Thyroid hormone replacement.',
        ],
    ]
];
