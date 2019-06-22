(function () {
    'use strict';

    angular
        .module('hero-module')
        .controller('HeroController', HeroController);

    HeroController.$inject = ['HeroService', '$location'];

    function HeroController(heroService, $location) {
        var self = this;
        self.viewData = {};
        self.hero = Hero();
        self.onSelectRace = onSelectRace;
        self.onSelectClass = onSelectClass;
        self.storeHero = storeHero;

        init();

        /**
         * Function for init data for view.
         * if a creation hero only get data for view (hero races)
         * if a edition hero get info of the hero and data for view
         *
         */
        function init() {
            if (window.id !== 0) {
                heroService.getHeroData(window.id).then(function (heroData) {
                    self.hero.init(heroData);

                    self.viewData.classes = heroData.classes;
                    self.viewData.weapons = heroData.weapons;
                });
            }

            self.viewData = heroService.getFormData().then(function (response) {
                Object.assign(self.viewData, response)
            });
        }

        /**
         * Function callback for on select class in form.
         * get creation rules (need last name and classes)
         * for a hero depending for selected race
         *
         */
        function onSelectRace() {
            if (self.hero.race == null)
                return;

            heroService.getAvailableClass(self.hero.race).then(function (response) {
                self.viewData.classes = response.classes;
                self.hero.setNeedLastName(response.needLastName);
                self.hero.resetClass()
            });
        }

        /**
         * Function callback for on select class in form.
         * get available weapons for a hero depending for selected class
         */
        function onSelectClass() {
            if (self.hero.class == null)
                return;

            heroService.getAvailableWeapons(self.hero.class).then(function (response) {
                self.viewData.weapons = response;
                self.hero.weapon = null;
            });
        }

        /**
         * Store hero in the sever.
         */
        function storeHero() {
            heroService.storeHero(self.hero).then(function (response) {
                if (!response.errors || response.errors.length === 0) {
                    window.location.replace("/hero");
                }
                self.viewData.errors = response.errors;
            });

        }
    }
})();
