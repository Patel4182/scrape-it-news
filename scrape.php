<?php
require_once 'simple_html_dom.php';

$pdo = new PDO("mysql:host=localhost;dbname=scraper_db", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function scrapeAndSave($pdo)
{
    $url = 'https://news.ycombinator.com/';
    $html = file_get_html($url);
    $headlines = [];

    foreach ($html->find('a.storylink, span.titleline > a') as $element) {
        $title = trim($element->plaintext);
        $href = trim($element->href);

        if (!$title || !$href) continue;

        $headlines[] = ['title' => $title, 'url' => $href];

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM news_headlines WHERE url = ?");
        $stmt->execute([$href]);
        if ($stmt->fetchColumn() == 0) {
            $stmt = $pdo->prepare("INSERT INTO news_headlines (title, url) VALUES (?, ?)");
            $stmt->execute([$title, $href]);
        }
    }
}

if (isset($_GET['scrape'])) {
    scrapeAndSave($pdo);
    echo json_encode(['status' => 'done']);
    exit;
}

$search = $_GET['search'] ?? '';
$query = "SELECT * FROM news_headlines WHERE title LIKE ? ORDER BY id DESC LIMIT 50";
$stmt = $pdo->prepare($query);
$stmt->execute(['%' . $search . '%']);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($results);
