$(document).ready(function() {

  var app = $.spapp({pageNotFound: 'page-404'}); // initialize

  app.route({view: 'home', load: 'index.html' });
  app.route({view: 'about', load: 'about.html' });
  app.route({view: 'contact', load: 'contact.html' });
  app.route({view: 'services', load: 'services.html' });
  app.route({view: 'page-404', load: 'page-404.html' });

  // run app
  app.run();

});
 