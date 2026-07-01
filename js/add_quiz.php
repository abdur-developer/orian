<?php
require_once "../include/dbcon.php";
// Quiz data
$quizData = [ 
    [
        "question" => "বাংলাদেশের স্বাধীনতা দিবস কত তারিখে পালিত হয়?",
        "options" => ["২৬শে মার্চ", "১৬ই ডিসেম্বর", "২১শে ফেব্রুয়ারি", "১৫ই আগস্ট"],
        "answer" => 0,
        "explanation" => "২৬শে মার্চ বাংলাদেশের স্বাধীনতা দিবস হিসেবে পালিত হয়, যখন ১৯৭১ সালে বাংলাদেশ স্বাধীনতার ঘোষণা দেয়।"
    ],
    [
        "question" => "বাংলাদেশের জাতীয় ফুল কি?",
        "options" => ["গোলাপ", "শাপলা", "গাঁদা", "বেলি"],
        "answer" => 1,
        "explanation" => "শাপলা বাংলাদেশের জাতীয় ফুল, যা জলজ পরিবেশে জন্মায়।"
    ],
    [
        "question" => "বাংলাদেশের দীর্ঘতম নদী কোনটি?",
        "options" => ["যমুনা", "পদ্মা", "মেঘনা", "ব্রহ্মপুত্র"],
        "answer" => 2,
        "explanation" => "মেঘনা বাংলাদেশের দীর্ঘতম নদী, যার মোট দৈর্ঘ্য প্রায় ১,২০০ কিলোমিটার।"
    ],
    [
        "question" => "বাংলাদেশের জাতীয় পাখি কোনটি?",
        "options" => ["ময়না", "দোয়েল", "কাক", "ময়ূর"],
        "answer" => 1,
        "explanation" => "দোয়েল বাংলাদেশের জাতীয় পাখি, যা ছোট ও সুরেলা কণ্ঠের জন্য পরিচিত।"
    ],
    [
        "question" => "বাংলাদেশের প্রথম প্রধানমন্ত্রী কে ছিলেন?",
        "options" => ["শেখ মুজিবুর রহমান", "তাজউদ্দীন আহমেদ", "জিয়াউর রহমান", "হুসেইন মুহাম্মদ এরশাদ"],
        "answer" => 1,
        "explanation" => "তাজউদ্দীন আহমেদ বাংলাদেশের প্রথম প্রধানমন্ত্রী ছিলেন, যিনি ১৯৭১ সালে মুক্তিযুদ্ধের সময় সরকার গঠন করেছিলেন।"
    ]
];

// Prepare statement --------------------`question`, `answer`, `explanation`, `options`, `cat_id
$stmt = $conn->prepare("INSERT INTO questions (question, options, answer, explanation, cat_id) VALUES (?, ?, ?, ?, ?)");

foreach ($quizData as $quiz) {
    $question = $quiz['question'];
    $options = json_encode($quiz['options'], JSON_UNESCAPED_UNICODE); // Unicode বাংলা ঠিক রাখতে
    $answer = $quiz['answer'];
    $explanation = $quiz['explanation'];
    $cat_id = 1; // Default category ID

    $stmt->bind_param("ssisi", $question, $options, $answer, $explanation, $cat_id);
    //$stmt->execute();
}

echo "Quiz data inserted successfully!";
$stmt->close();
$conn->close();
?>
