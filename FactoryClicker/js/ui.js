/*jslint browser: true*/
/*jslint plusplus: true */
/*global $, jQuery, numeral, alert*/

// Factory constructor
function Factory(name) {
    'use strict';
    this.workerCount = 0;
    this.workerPrice = 10;
    this.workerUpgrade1 = false;
    this.workerUpgrade1Price = 500;
    this.workerUpgrade2 = false;
    this.workerUpgrade2Price = 5000;
    this.shoePWorker = 1;
    this.robotCount = 0;
    this.robotPrice = 1000;
    this.robotUpgrade1 = false;
    this.robotUpgrade1Price = 5000;
    this.robotUpgrade2 = false;
    this.robotUpgrade2Price = 15000;
    this.shoePRobot = 10;
    this.shoeLacesPSec = 0;
    this.salesPeonCount = 0;
    this.salesPeonPrice = 100;
    this.salesPeonQuality = 2;
    this.salesPeonUpgrade1 = false;
    this.salesPeonUpgrade1Price = 500;
    this.salesPeonUpgrade2 = false;
    this.salesPeonUpgrade2Price = 5000;
    this.salesManagerCount = 0;
    this.salesManagerPrice = 500;
    this.salesManagerQuality = 6;
    this.salesManagerUpgrade1 = false;
    this.salesManagerUpgrade1Price = 1000;
    this.salesManagerUpgrade2 = false;
    this.salesManagerUpgrade2Price = 10000;
    this.salesPSec = 0;
    this.increasePrice = 5000;
    this.decreasePrice = 5000;
}

//Variable declarations
var totalMoney = 0;
var totalSales = 0;
var moneyPSec = 0;
var salesPSec = 0;
var shoePrice = 1;
var totalShoe = 0;
var shoePSec = 0;
var shoePClick = 1;
var factories = [];
//Create first factory... All factories kept in an array
factories.push(new Factory('yes'));

//A function that updates all of the info
function updateInfo() {
    "use strict";
    $('#totalMoney').text(numeral(totalMoney).format('$0,0.00a'));
    $('#moneyPSec').text(numeral(moneyPSec).format('$0,0.00a'));
    $('#totalShoe').text(numeral(totalShoe).format('0.00a'));
    $('#shoePSec').text(numeral(shoePSec).format('0.00a'));
    $('#shoePWorker').text(numeral(factories[0].shoePWorker).format('0,0.0'));
    $('#workerCount').text(factories[0].workerCount);
    $('#workerPrice').text(numeral(factories[0].workerPrice).format('$0,0.00a'));
    $('#workerUpgrade1Price').text(numeral(factories[0].workerUpgrade1Price).format('$0,0.00'));
    $('#workerUpgrade2Price').text(numeral(factories[0].workerUpgrade2Price).format('$0,0.00'));
    $('#shoePRobot').text(numeral(factories[0].shoePRobot).format('0,0.0'));
    $('#robotCount').text(factories[0].robotCount);
    $('#robotPrice').text(numeral(factories[0].robotPrice).format('$0,0.00a'));
    $('#robotUpgrade1Price').text(numeral(factories[0].robotUpgrade1Price).format('$0,0.00'));
    $('#robotUpgrade2Price').text(numeral(factories[0].robotUpgrade2Price).format('$0,0.00'));
    $('#shoeSalesPeonPSec').text(numeral(factories[0].salesPeonQuality).format('0,0.0'));
    $('#shoePrice').text(numeral(shoePrice).format('$0,0.00'));
    $('#salesPeonCount').text(factories[0].salesPeonCount);
    $('#salesPeonPrice').text(numeral(factories[0].salesPeonPrice).format('$0,0.00'));
    $('#salesPeonUpgrade1Price').text(numeral(factories[0].salesPeonUpgrade1Price).format('$0,0.00'));
    $('#salesPeonUpgrade2Price').text(numeral(factories[0].salesPeonUpgrade2Price).format('$0,0.00'));
    $('#salesManagerCount').text(factories[0].salesManagerCount);
    $('#salesManagerPrice').text(numeral(factories[0].salesManagerPrice).format('$0,0.00a'));
    $('#shoeSalesManagerPSec').text(numeral(factories[0].salesManagerQuality).format('0,0.0'));
    $('#salesManagerUpgrade1Price').text(numeral(factories[0].salesManagerUpgrade1Price).format('$0,0.00'));
    $('#salesManagerUpgrade2Price').text(numeral(factories[0].salesManagerUpgrade2Price).format('$0,0.00'));
    $('#totalSales').text(numeral(totalSales).format('0.00a'));
    $('#salesPSec').text(numeral(factories[0].salesPSec).format('0.00a'));
    $('#moneyPSec').text(numeral(moneyPSec).format('$0,0.00'));
    $('#increasePrice').text(numeral(factories[0].increasePrice).format('$0,0.00'));
    $('#decreasePrice').text(numeral(factories[0].decreasePrice).format('$0,0.00'));
}

//Sell shoe
function sellShoeClick() {
    "use strict";
    if (totalShoe >= 2) {
        totalSales += shoePClick;
        totalMoney += shoePrice;
        totalShoe -= 2;
    }
    updateInfo();
}

//Create shoe
function addShoeClick() {
    "use strict";
    totalShoe += shoePClick;
    updateInfo();
}

//Updates shoes per second
function updateShoePFactory(factoryNumber) {
    "use strict";
    var i;
    //Calculate shoes per second
    factories[factoryNumber].shoeLacesPSec = Math.round(factories[factoryNumber].workerCount * factories[factoryNumber].shoePWorker, 0);
    factories[factoryNumber].shoeLacesPSec += Math.round(factories[factoryNumber].robotCount * factories[factoryNumber].shoePRobot, 0);
    shoePSec = 0;
    for (i = 0; i < factories.length; i++) {
        shoePSec += factories[i].shoeLacesPSec;
    }
    
    updateInfo();
}

//Updates sales per second
function updateSalesPFactory(factoryNumber) {
    "use strict";
    var i;
    //Calculate sales per second
    factories[factoryNumber].salesPSec = Math.round(factories[factoryNumber].salesPeonCount * factories[factoryNumber].salesPeonQuality);
    factories[factoryNumber].salesPSec += Math.round(factories[factoryNumber].salesManagerCount * factories[factoryNumber].salesManagerQuality);
    
    salesPSec = 0;
    for (i = 0; i < factories.length; i++) {
        salesPSec += factories[i].salesPSec;
    }
    updateInfo();
}

//Hire worker
function hireWorker() {
    "use strict";
    if (totalMoney >= factories[0].workerPrice) {
        factories[0].workerCount++;
        totalMoney -= factories[0].workerPrice;
        factories[0].workerPrice = Math.round(factories[0].workerPrice * 1.1);
        updateShoePFactory(0);
    }
    updateInfo();
}

//Hire robot cuz you can
function hireRobot() {
    "use strict";
    if (totalMoney >= factories[0].robotPrice) {
        factories[0].robotCount++;
        totalMoney -= factories[0].robotPrice;
        factories[0].robotPrice = Math.round(factories[0].robotPrice * 1.1);
        updateShoePFactory(0);
    }
    updateInfo();
}

//Hire salespeon
function hireSalesPeon() {
    "use strict";
    if (totalMoney >= factories[0].salesPeonPrice) {
        factories[0].salesPeonCount++;
        totalMoney -= factories[0].salesPeonPrice;
        factories[0].salesPeonPrice = Math.round(factories[0].salesPeonPrice * 1.1);
        updateSalesPFactory(0);
    }
    updateInfo();
}

//Hire salesmanager
function hireSalesManager() {
    "use strict";
    
    if (totalMoney >= factories[0].salesManagerPrice) {
        factories[0].salesManagerCount++;
        totalMoney -= factories[0].salesManagerPrice;
        factories[0].salesManagerPrice = Math.round(factories[0].salesManagerPrice * 1.1);
        updateSalesPFactory(0);
    }
    updateInfo();
}

//Worker upgrade numero uno
function workerUpgrade1() {
    "use strict";
    
    if (totalMoney >= factories[0].workerUpgrade1Price && !factories[0].workerUpgrade1) {
        factories[0].shoePWorker += 0.1;
        factories[0].workerUpgrade1 = true;
        totalMoney -= factories[0].workerUpgrade1Price;
        updateShoePFactory(0);
        updateInfo();
        $('#workerUpgrade1').addClass('secondary');
        $('#workerUpgrade1').removeClass('info');
    }
}

//Worker upgrade numero dos
function workerUpgrade2() {
    "use strict";
    
    if (totalMoney >= factories[0].workerUpgrade2Price && !factories[0].workerUpgrade2) {
        factories[0].shoePWorker += 0.5;
        factories[0].workerUpgrade2 = true;
        totalMoney -= factories[0].workerUpgrade2Price;
        updateShoePFactory(0);
        updateInfo();
        $('#workerUpgrade2').addClass('secondary');
        $('#workerUpgrade2').removeClass('info');
    }
}

//Robot upgrade numero uno
function robotUpgrade1() {
    "use strict";
    
    if (totalMoney >= factories[0].robotUpgrade1Price && !factories[0].robotUpgrade1) {
        factories[0].shoePRobot += 0.1;
        factories[0].robotUpgrade1 = true;
        totalMoney -= factories[0].robotUpgrade1Price;
        updateShoePFactory(0);
        updateInfo();
        $('#robotUpgrade1').addClass('secondary');
        $('#robotUpgrade1').removeClass('info');
    }
}

//Robot upgrade numero dos
function robotUpgrade2() {
    "use strict";
    
    if (totalMoney >= factories[0].robotUpgrade2Price && !factories[0].robotUpgrade2) {
        factories[0].shoePRobot += 0.5;
        factories[0].robotUpgrade2 = true;
        totalMoney -= factories[0].robotUpgrade2Price;
        updateShoePFactory(0);
        updateInfo();
        $('#robotUpgrade2').addClass('secondary');
        $('#robotUpgrade2').removeClass('info');
    }
}

//Sales upgrade numero uno
function salesPeonUpgrade1() {
    "use strict";
    
    if (totalMoney >= factories[0].salesPeonUpgrade2Price && !factories[0].salesPeonUpgrade1) {
        factories[0].salesPeonQuality += 0.1;
        factories[0].salesPeonUpgrade1 = true;
        totalMoney -= factories[0].salesPeonUpgrade1Price;
        updateSalesPFactory(0);
        updateInfo();
        $('#salesPeonUpgrade1').addClass('secondary');
        $('#salesPeonUpgrade1').removeClass('info');
    }
}

//Sales upgrade numero dos
function salesPeonUpgrade2() {
    "use strict";
    if (totalMoney >= factories[0].salesPeonUpgrade2Price && !factories[0].salesPeonUpgrade2) {
        factories[0].salesPeonQuality += 0.2;
        factories[0].salesPeonUpgrade2 = true;
        totalMoney -= factories[0].salesPeonUpgrade2Price;
        updateSalesPFactory(0);
        updateInfo();
        $('#salesPeonUpgrade2').addClass('secondary');
        $('#salesPeonUpgrade2').removeClass('info');
    }
}

//Sales upgrade numero uno
function salesManagerUpgrade1() {
    "use strict";
    
    if (totalMoney >= factories[0].salesManagerUpgrade1Price && !factories[0].salesManagerUpgrade1) {
        factories[0].salesManagerQuality += 0.1;
        factories[0].salesManagerUpgrade1 = true;
        totalMoney -= factories[0].salesManagerUpgrade1Price;
        updateSalesPFactory(0);
        updateInfo();
        $('#salesManagerUpgrade1').addClass('secondary');
        $('#salesManagerUpgrade1').removeClass('info');
    }
}

//Sales upgrade numero dos
function salesManagerUpgrade2() {
    "use strict";
    if (totalMoney >= factories[0].salesManagerUpgrade2Price && !factories[0].salesManagerUpgrade2) {
        factories[0].salesManagerQuality += 0.2;
        factories[0].salesManagerUpgrade2 = true;
        totalMoney -= factories[0].salesManagerUpgrade2Price;
        updateSalesPFactory(0);
        updateInfo();
        $('#salesManagerUpgrade2').addClass('secondary');
        $('#salesManagerUpgrade2').removeClass('info');
    }
}

function increasePrice() {
    "use strict";
    if (totalMoney >= factories[0].increasePrice) {
        shoePrice += 0.2;
        totalMoney -= factories[0].increasePrice;
        factories[0].increasePrice *= 2;
    }
}

$(document).ready(function () {
    "use strict";
    updateInfo();
    
    //This happens every second
    window.setInterval(function () {
        totalShoe += shoePSec;
        if (totalShoe >= salesPSec) {
            totalShoe -= salesPSec;
            totalSales += salesPSec;
            moneyPSec = salesPSec * shoePrice;
            totalMoney += moneyPSec;
        }
        updateInfo();
    }, 1000);
});