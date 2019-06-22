var HeroService = (function ($q) {
    'use strict';

    /**
     * Get data for view (available hero races).
     * @param
     */
    function getFormData() {
        return $q(function (resolve, reject) {
            $.ajax({
                method: "GET",
                url: "/hero/formData",
            })
                .done(function (response) {
                    resolve(response);
                })
                .fail(function (reason) {
                    reject(reason);
                })
                .always(function () {
                });
        });
    }

    /**
     * Get available race for a hero race.
     * @param {number} heroRace
     */
    function getAvailableClass(heroRace) {
        return $q(function (resolve, reject) {
            $.ajax({
                method: "GET",
                url: "/hero/availableClass/" + heroRace,
            })
                .done(function (response) {
                    resolve(response);
                })
                .fail(function (reason) {
                    reject(reason);
                })
                .always(function () {
                });
        });
    }


    /**
     * Get available weapons for a hero class.
     * @param {number} heroClass
     */
    function getAvailableWeapons(heroClass) {
        return $q(function (resolve, reject) {
            $.ajax({
                method: "GET",
                url: "/hero/availableWeapons/" + heroClass,
            })
                .done(function (response) {
                    resolve(response);
                })
                .fail(function (reason) {
                    reject(reason);
                })
                .always(function () {
                });
        });
    }

    /**
     * Send post request to store a  hero.
     * @param {Hero} hero
     */
    function storeHero(hero) {
        var request = {
            'id': hero.id,
            'first_name': hero.firstName,
            'last_name': hero.lastName,
            'race': hero.race,
            'class': hero.class,
            'weapon': hero.weapon,
            'strength': hero.strength.result,
            'intelligence': hero.intelligence.result,
            'dexterity': hero.dexterity.result
        };

        return $q(function (resolve, reject) {
            $.ajax({
                method: "POST",
                url: "/hero/create",
                data: request,
            })
                .done(function (response) {
                    resolve(response);
                })
                .fail(function (reason) {
                    reject(reason);
                })
                .always(function () {
                });
        });
    }


    /**
     * Get info for edition hero.
     * @param {number} id hero id
     */

    function getHeroData(id) {
        return $q(function (resolve, reject) {
            $.ajax({
                method: "GET",
                url: "/hero/data/" + id,
            })
                .done(function (response) {
                    resolve(response);
                })
                .fail(function (reason) {
                    reject(reason);
                })
                .always(function () {
                });
        });
    }


    return {
        getFormData: getFormData,
        getAvailableClass: getAvailableClass,
        getAvailableWeapons: getAvailableWeapons,
        storeHero: storeHero,
        getHeroData: getHeroData
    }
});
