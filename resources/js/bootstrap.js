import axios from 'axios'
import Alpine from 'alpinejs'
import $ from 'jquery'
import maplibregl from 'maplibre-gl'
import '@fortawesome/fontawesome-free/js/fontawesome.min.js'
import '@fortawesome/fontawesome-free/js/regular.min.js'
import 'maplibre-gl/dist/maplibre-gl.css'
// import { marked } from 'marked'
// import EasyMDE from 'easymde'
/* Import TinyMCE */
import tinymce from 'tinymce';

/* Default icons are required. After that, import custom icons if applicable */
import 'tinymce/icons/default/icons.min.js';

/* Required TinyMCE components */
import 'tinymce/themes/silver/theme.min.js';
import 'tinymce/models/dom/model.min.js';

/* Import the default skin (oxide). Replace with a custom skin if required. */
import 'tinymce/skins/ui/oxide/skin.js';

/* Import plugins */
import 'tinymce/plugins/advlist';
import 'tinymce/plugins/code';
import 'tinymce/plugins/emoticons';
import 'tinymce/plugins/emoticons/js/emojis';
import 'tinymce/plugins/link';
import 'tinymce/plugins/lists';
import 'tinymce/plugins/table';
import 'tinymce/plugins/help';
import 'tinymce/plugins/help/js/i18n/keynav/en';

/* content UI CSS is required (using the default oxide skin) */
import 'tinymce/skins/ui/oxide/content.js';

/* The default content CSS can be changed or replaced with appropriate CSS for the editor content. */
import 'tinymce/skins/content/default/content.js';

window.$ = window.jQuery = $
window.axios = axios
window.Alpine = Alpine
window.maplibregl = maplibregl
// window.marked = marked
// window.EasyMDE = EasyMDE
window.tinymce = tinymce

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
Alpine.start()
