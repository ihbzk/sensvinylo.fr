<?php

function generateSitemap($db_client)
{
    $stmt = $db_client->prepare("SELECT * FROM studios");
    $stmt->execute();
    $studios = $stmt->fetchAll(PDO::FETCH_OBJ);

    $stmt2 = $db_client->prepare("SELECT * FROM project");
    $stmt2->execute();
    $projects = $stmt2->fetchAll(PDO::FETCH_OBJ);

    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
    $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

    $sitemap .= '<url>
    <loc>https://www.sensvinylo.fr/</loc>
    <lastmod>' . date('Y-m-d\TH:i:sP') . '</lastmod>
    <priority>1.00</priority>
    </url>
    <url>
    <loc>https://www.sensvinylo.fr/sensvinylo</loc>
    <lastmod>' . date('Y-m-d\TH:i:sP') . '</lastmod>
    <priority>0.90</priority>
    </url>
    <url>
    <loc>https://www.sensvinylo.fr/revetement-vinyle-paris</loc>
    <lastmod>' . date('Y-m-d\TH:i:sP') . '</lastmod>
    <priority>0.80</priority>
    </url>
    <url>
    <loc>https://www.sensvinylo.fr/decoration-vinyle-sur-mesure</loc>
    <lastmod>' . date('Y-m-d\TH:i:sP') . '</lastmod>
    <priority>0.80</priority>
    </url>
    <url>
    <loc>https://www.sensvinylo.fr/pourquoi-nous-choisir</loc>
    <lastmod>' . date('Y-m-d\TH:i:sP') . '</lastmod>
    <priority>0.80</priority>
    </url>
    <url>
    <loc>https://www.sensvinylo.fr/conseils-et-inspirations</loc>
    <lastmod>' . date('Y-m-d\TH:i:sP') . '</lastmod>
    <priority>0.80</priority>
    </url>
    <url>
    <loc>https://www.sensvinylo.fr/faq</loc>
    <lastmod>' . date('Y-m-d\TH:i:sP') . '</lastmod>
    <priority>0.90</priority>
    </url>
    <url>
    <loc>https://www.sensvinylo.fr/mentions-legales</loc>
    <lastmod>' . date('Y-m-d\TH:i:sP') . '</lastmod>
    <priority>0.90</priority>
    </url>
    <url>
    <loc>https://www.sensvinylo.fr/politique-de-confidentialite</loc>
    <lastmod>' . date('Y-m-d\TH:i:sP') . '</lastmod>
    <priority>0.90</priority>
    </url>
    <url>
    <loc>https://www.sensvinylo.fr/contact</loc>
    <lastmod>' . date('Y-m-d\TH:i:sP') . '</lastmod>
    <priority>0.90</priority>
    </url>
    <url>
    <loc>https://www.sensvinylo.fr/studios</loc>
    <lastmod>' . date('Y-m-d\TH:i:sP') . '</lastmod>
    <priority>0.90</priority>
    </url>
    <url>
    <loc>https://www.sensvinylo.fr/projets</loc>
    <lastmod>' . date('Y-m-d\TH:i:sP') . '</lastmod>
    <priority>0.90</priority>
    </url>';

    foreach ($studios as $studio) {
        $slug = $studio->slug;
        $slug = strtolower($slug);
        $url = "https://www.sensvinylo.fr/studio-" . $slug;

        $sitemap .= '<url>' . PHP_EOL;
        $sitemap .= '  <loc>' . $url . '</loc>' . PHP_EOL;
        $sitemap .= '  <lastmod>' . date('Y-m-d\TH:i:sP') . '</lastmod>' . PHP_EOL;
        $sitemap .= '  <priority>0.80</priority>' . PHP_EOL;
        $sitemap .= '</url>' . PHP_EOL;
    }

    foreach ($projects as $project) {
        $slug = $project->slug;
        $slug = strtolower($slug);
        $url = "https://www.sensvinylo.fr/projet-" . $slug;

        $sitemap .= '<url>' . PHP_EOL;
        $sitemap .= '  <loc>' . $url . '</loc>' . PHP_EOL;
        $sitemap .= '  <lastmod>' . date('Y-m-d\TH:i:sP') . '</lastmod>' . PHP_EOL;
        $sitemap .= '  <priority>0.80</priority>' . PHP_EOL;
        $sitemap .= '</url>' . PHP_EOL;
    }

    $sitemap .= '</urlset>';

    return $sitemap;
}

$sitemapContent = generateSitemap($db_client);

file_put_contents('sitemap.xml', $sitemapContent);