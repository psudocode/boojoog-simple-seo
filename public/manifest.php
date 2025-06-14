<?php
// Set the correct content type for JSON
header('Content-Type: application/manifest+json');

// Dynamically generate the manifest content
$manifest = [
    "name" => get_bloginfo('name'),
    "short_name" => get_bloginfo('name'),
    "description" => get_bloginfo('description'),
    "start_url" => home_url('/'),
    "display" => "standalone",
    "background_color" => "#ffffff",
    "theme_color" => "#0073aa",
    "icons" => [
        [
            "src" => get_template_directory_uri() . "/icons/icon-192x192.png",
            "sizes" => "192x192",
            "type" => "image/png"
        ],
        [
            "src" => get_template_directory_uri() . "/icons/icon-512x512.png",
            "sizes" => "512x512",
            "type" => "image/png"
        ]
    ]
];

// Output the JSON
echo json_encode($manifest, JSON_PRETTY_PRINT);
exit;