import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import fs from "fs";
import path from "path";

// Helper to recursively find all JS and CSS files
function getAssetFiles(dir) {
    let results = [];
    fs.readdirSync(dir).forEach((file) => {
        const fullPath = path.join(dir, file);
        const stat = fs.statSync(fullPath);
        if (stat && stat.isDirectory()) {
            results = results.concat(getAssetFiles(fullPath));
        } else if (/\.(js|css)$/.test(fullPath)) {
            results.push(fullPath.replace(/^resources[\/\\]/, "resources/"));
        }
    });
    return results;
}

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                ...getAssetFiles("resources/frontend/assets"),
            ],
            refresh: true,
        }),
    ],
});
