(function () {
    'use strict';

    angular.module('hero-module', [], function ($interpolateProvider) {
        /**
         * Change AngularJS default interpolateProvider for resolve conflicts with Laravel blade pages.
         */
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
})();
