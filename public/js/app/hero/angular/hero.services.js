/**
 * Register dependencies for hero module.
 */
(function () {
    'use strict';
    angular
        .module('hero-module')
        .service('HeroService', ['$q', HeroService]);
})();
