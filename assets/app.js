import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

document.addEventListener('chartjs:init', function (event) {
    const Chart = event.detail.Chart;
    const Tooltip = Chart.registry.plugins.get('tooltip');
    Tooltip.positioners.bottom = function(items) {
        /* ... */
    };
});
console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
