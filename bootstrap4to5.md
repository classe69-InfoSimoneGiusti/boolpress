Dentro  package.json modificare  "bootstrap": "^4.0.0" in  "bootstrap": "^5.2.0"

Lanciare da terminale npm install @popperjs/core --save

Modifica il file resources/js/bootstrap.js cambiando   window.Popper = require('popper.js').default; in     window.Popper = require('@popperjs/core');

Rilancia la compilazione di webpack con npm run dev
