var Hero = (function () {
    'use strict';

    /**
     *  Command function to resent
     *  class and weapon for hero.
     */
    function resetClass() {
        this.class = null;
        this.weapon = null;
    }

    /**
     *  Command function to set if hero neet last name
     *  if not needed the last name is reset.
     */
    function setNeedLastName(needLastName) {
        this.needLastName = needLastName;
        if (!needLastName)
            this.lastName = '';
    }

    /**
     *  Command function to reset a hero
     *  all variables are reset
     */
    function reset() {
        this.firstName = '';
        this.lastName = '';
        this.race = null;
        this.class = null;
        this.weapon = null;
        this.needLastName = true;
        this.strength = Stat(1, 6);
        this.intelligence = Stat(1, 6);
        this.dexterity = Stat(1, 6);
    }

    /**
     *  Command function to init a hero
     *  @param data for init a hero
     */
    function init(data) {
        this.id = data.id;
        this.firstName = data.first_name;
        this.lastName = data.last_name;
        this.race = data.race;
        this.class = data.class;
        this.weapon = data.weapon;
        this.needLastName = data.needLastName;
        this.strength = Stat(1, 6, data.strength);
        this.intelligence = Stat(1, 6, data.intelligence);
        this.dexterity = Stat(1, 6, data.dexterity);
    }

    return {
        id: 0,
        firstName: '',
        lastName: '',
        race: null,
        class: null,
        weapon: null,
        needLastName: true,
        strength: Stat(1, 6),
        intelligence: Stat(1, 6),
        dexterity: Stat(1, 6),
        init: init,
        reset: reset,
        setNeedLastName: setNeedLastName,
        resetClass: resetClass
    }
});


var Stat = (function (min, max, result) {
    'use strict';
    var self;

    /**
     * defaul value for invalid result do roll stat.
     * @type {number}
     */
    var notValidResult = -9999;

    /**
     * Command function do roll stat.
     * Change the values for calculate stat, calculate result
     * and determinate if a valid result.
     *
     */
    function roll() {
        self.itsRolled = true;
        setRandomValues();
        sortValues();
        calculateResult();
        self.values[0].itsHigher = false;
    }

    /**
     * Command function to change random
     * the values for calculate stat.
     *
     */
    function setRandomValues() {
        self.values.forEach(function (val) {
            val.setRandomValue();
        });
    }
    /**
     * Query function to check if
     * the values for calculate stat has a duplicates values.
     *
     */
    function hasDuplicateValues() {
        var valuesSoFar = [];
        for (var i = 0; i < self.values.length; ++i) {
            var value = self.values[i].val;
            if (value in valuesSoFar) {
                return true;
            }
            valuesSoFar[value] = true;
        }
        return false;
    }

    /**
     * Command function to sort desc
     * the values for calculate stat.
     *
     */
    function sortValues() {
        self.values.sort(function (a, b) {
            var valA = a.val,
                valB = b.val;
            // Compare the 2 dates
            if (valA < valB) return -1;
            if (valA > valB) return 1;
            return 0;
        });
    }

    /**
     * Command function to sort desc
     * if the values for calculate stat has a duplicate values
     * the result is not valid,
     * otherwise process to calculate the result.
     *
     */
    function calculateResult() {
        if (hasDuplicateValues())
            self.result = notValidResult;
        else {
            self.result = 0;
            for (var i = 1; i < self.values.length; ++i) {
                self.result += self.values[i].val;
            }
        }

    }

    /**
     * Query function to check if the current result of stat is valid
     *
     */
    function isValidResult() {
        return self.result !== notValidResult;
    }

    return self = {
        values: [
            StatValueRandom(min, max),
            StatValueRandom(min, max),
            StatValueRandom(min, max),
            StatValueRandom(min, max)
        ],
        result: result || 0,
        itsRolled: false,
        isValidResult: isValidResult,
        roll: roll
    }
});


var StatValueRandom = (function (min, max) {
    'use strict';
    /**
     * Command function to assign a random value.
     *
     */
    function setRandomValue() {
        this.itsHigher = true;
        return this.val = Math.floor(Math.random() * (max - min)) + min;
    }

    return {
        val: 0,
        itsHigher: true,
        setRandomValue: setRandomValue
    }
});

