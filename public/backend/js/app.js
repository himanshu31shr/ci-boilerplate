/*****
* CONFIGURATION
*/

//Main navigation
$.navigation = $('nav > ul.nav');

$.panelIconOpened = 'icon-arrow-up';
$.panelIconClosed = 'icon-arrow-down';

//Default colours
$.brandPrimary =  '#20a8d8';
$.brandSuccess =  '#4dbd74';
$.brandInfo =     '#63c2de';
$.brandWarning =  '#f8cb00';
$.brandDanger =   '#f86c6b';

$.grayDark =      '#2a2c36';
$.gray =          '#55595c';
$.grayLight =     '#818a91';
$.grayLighter =   '#d1d4d7';
$.grayLightest =  '#f8f9fa';

'use strict';

/****
* MAIN NAVIGATION
*/

$(document).ready(function($){

  // Add class .active to current link
  $.navigation.find('a').each(function(){

    var cUrl = String(window.location).split('?')[0];

    if (cUrl.substr(cUrl.length - 1) == '#') {
      cUrl = cUrl.slice(0,-1);
    }

    if ($($(this))[0].href==cUrl) {
      $(this).addClass('active');

      $(this).parents('ul').add(this).each(function(){
        $(this).parent().addClass('open');
      });
    }
  });

  // Dropdown Menu
  $.navigation.on('click', 'a', function(e){

    if ($.ajaxLoad) {
      e.preventDefault();
    }

    if ($(this).hasClass('nav-dropdown-toggle')) {
      $(this).parent().toggleClass('open');
      resizeBroadcast();
    }

  });

  function resizeBroadcast() {

    var timesRun = 0;
    var interval = setInterval(function(){
      timesRun += 1;
      if(timesRun === 5){
        clearInterval(interval);
      }
      window.dispatchEvent(new Event('resize'));
    }, 62.5);
  }

  /* ---------- Main Menu Open/Close, Min/Full ---------- */
  $('.sidebar-toggler').click(function(){
    $('body').toggleClass('sidebar-hidden');
    resizeBroadcast();
  });

  $('.sidebar-minimizer').click(function(){
    $('body').toggleClass('sidebar-minimized');
    resizeBroadcast();
  });

  $('.brand-minimizer').click(function(){
    $('body').toggleClass('brand-minimized');
  });

  $('.aside-menu-toggler').click(function(){
    $('body').toggleClass('aside-menu-hidden');
    resizeBroadcast();
  });

  $('.mobile-sidebar-toggler').click(function(){
    $('body').toggleClass('sidebar-mobile-show');
    resizeBroadcast();
  });

  $('.sidebar-close').click(function(){
    $('body').toggleClass('sidebar-opened').parent().toggleClass('sidebar-opened');
  });

  /* ---------- Disable moving to top ---------- */
  $('a[href="#"][data-top!=true]').click(function(e){
    e.preventDefault();
  });

});

/****
* CARDS ACTIONS
*/

$('.card-actions').on('click', 'a, button', function(e){
  e.preventDefault();

  if ($(this).hasClass('btn-close')) {
    $(this).parent().parent().parent().fadeOut();
  } else if ($(this).hasClass('btn-minimize')) {
    // var $target = $(this).parent().parent().next('.card-body').collapse({toggle: true});
    if ($(this).hasClass('collapsed')) {
      $('i',$(this)).removeClass($.panelIconOpened).addClass($.panelIconClosed);
    } else {
      $('i',$(this)).removeClass($.panelIconClosed).addClass($.panelIconOpened);
    }
  } else if ($(this).hasClass('btn-setting')) {
    $('#myModal').modal('show');
  }

});

function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

function init(url) {

  /* ---------- Tooltip ---------- */
  $('[rel="tooltip"],[data-rel="tooltip"]').tooltip({"placement":"bottom",delay: { show: 400, hide: 200 }});

  /* ---------- Popover ---------- */
  $('[rel="popover"],[data-rel="popover"],[data-toggle="popover"]').popover();

}

$(function(){
  'use strict';

  //convert Hex to RGBA
  function convertHex(hex,opacity){
    hex = hex.replace('#','');
    var r = parseInt(hex.substring(0,2), 16);
    var g = parseInt(hex.substring(2,4), 16);
    var b = parseInt(hex.substring(4,6), 16);

    var result = 'rgba('+r+','+g+','+b+','+opacity/100+')';
    return result;
  }

  //Cards with Charts
  var labels = ['January','February','March','April','May','June','July'];
  var data = {
    labels: labels,
    datasets: [
      {
        label: 'My First dataset',
        backgroundColor: $.brandPrimary,
        borderColor: 'rgba(255,255,255,.55)',
        data: [65, 59, 84, 84, 51, 55, 40]
      },
    ]
  };
  var options = {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines: {
          color: 'transparent',
          zeroLineColor: 'transparent'
        },
        ticks: {
          fontSize: 2,
          fontColor: 'transparent',
        }

      }],
      yAxes: [{
        display: false,
        ticks: {
          display: false,
          min: Math.min.apply(Math, data.datasets[0].data) - 5,
          max: Math.max.apply(Math, data.datasets[0].data) + 5,
        }
      }],
    },
    elements: {
      line: {
        borderWidth: 1
      },
      point: {
        radius: 4,
        hitRadius: 10,
        hoverRadius: 4,
      },
    }
  };
  var ctx = $('#card-chart1');
  var cardChart1 = new Chart(ctx, {
    type: 'line',
    data: data,
    options: options
  });

  var data = {
    labels: labels,
    datasets: [
      {
        label: 'My First dataset',
        backgroundColor: $.brandInfo,
        borderColor: 'rgba(255,255,255,.55)',
        data: [1, 18, 9, 17, 34, 22, 11]
      },
    ]
  };
  var options = {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines: {
          color: 'transparent',
          zeroLineColor: 'transparent'
        },
        ticks: {
          fontSize: 2,
          fontColor: 'transparent',
        }

      }],
      yAxes: [{
        display: false,
        ticks: {
          display: false,
          min: Math.min.apply(Math, data.datasets[0].data) - 5,
          max: Math.max.apply(Math, data.datasets[0].data) + 5,
        }
      }],
    },
    elements: {
      line: {
        tension: 0.00001,
        borderWidth: 1
      },
      point: {
        radius: 4,
        hitRadius: 10,
        hoverRadius: 4,
      },
    }
  };
  var ctx = $('#card-chart2');
  var cardChart2 = new Chart(ctx, {
    type: 'line',
    data: data,
    options: options
  });

  var options = {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        display: false
      }],
      yAxes: [{
        display: false
      }],
    },
    elements: {
      line: {
        borderWidth: 2
      },
      point: {
        radius: 0,
        hitRadius: 10,
        hoverRadius: 4,
      },
    }
  };
  var data = {
    labels: labels,
    datasets: [
      {
        label: 'My First dataset',
        backgroundColor: 'rgba(255,255,255,.2)',
        borderColor: 'rgba(255,255,255,.55)',
        data: [78, 81, 80, 45, 34, 12, 40]
      },
    ]
  };
  var ctx = $('#card-chart3');
  var cardChart3 = new Chart(ctx, {
    type: 'line',
    data: data,
    options: options
  });

  //Random Numbers
  function random(min,max) {
    return Math.floor(Math.random()*(max-min+1)+min);
  }

  var elements = 16;
  var labels = [];
  var data = [];

  for (var i = 2000; i <= 2000 + elements; i++) {
    labels.push(i);
    data.push(random(40,100));
  }

  var options = {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        display: false,
        barPercentage: 0.6,
      }],
      yAxes: [{
        display: false,
      }]
    },

  };
  var data = {
    labels: labels,
    datasets: [
      {
        backgroundColor: 'rgba(255,255,255,.3)',
        borderColor: 'transparent',
        data: data
      },
    ]
  };
  var ctx = $('#card-chart4');
  var cardChart4 = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: options
  });

  //Main Chart
  var elements = 27;
  var data1 = [];
  var data2 = [];
  var data3 = [];

  for (var i = 0; i <= elements; i++) {
    data1.push(random(50,200));
    data2.push(random(80,100));
    data3.push(65);
  }

  var data = {
    labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S', 'M', 'T', 'W', 'T', 'F', 'S', 'S', 'M', 'T', 'W', 'T', 'F', 'S', 'S', 'M', 'T', 'W', 'T', 'F', 'S', 'S'],
    datasets: [
      {
        label: 'My First dataset',
        backgroundColor: convertHex($.brandInfo,10),
        borderColor: $.brandInfo,
        pointHoverBackgroundColor: '#fff',
        borderWidth: 2,
        data: data1
      },
      {
        label: 'My Second dataset',
        backgroundColor: 'transparent',
        borderColor: $.brandSuccess,
        pointHoverBackgroundColor: '#fff',
        borderWidth: 2,
        data: data2
      },
      {
        label: 'My Third dataset',
        backgroundColor: 'transparent',
        borderColor: $.brandDanger,
        pointHoverBackgroundColor: '#fff',
        borderWidth: 1,
        borderDash: [8, 5],
        data: data3
      }
    ]
  };

  var options = {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines: {
          drawOnChartArea: false,
        }
      }],
      yAxes: [{
        ticks: {
          beginAtZero: true,
          maxTicksLimit: 5,
          stepSize: Math.ceil(250 / 5),
          max: 250
        }
      }]
    },
    elements: {
      point: {
        radius: 0,
        hitRadius: 10,
        hoverRadius: 4,
        hoverBorderWidth: 3,
      }
    },
  };
  var ctx = $('#main-chart');
  var mainChart = new Chart(ctx, {
    type: 'line',
    data: data,
    options: options
  });


  //Social Box Charts
  var labels = ['January','February','March','April','May','June','July'];

  var options = {
    responsive: true,
    maintainAspectRatio: false,
    legend: {
      display: false,
    },
    scales: {
      xAxes: [{
        display:false,
      }],
      yAxes: [{
        display:false,
      }]
    },
    elements: {
      point: {
        radius: 0,
        hitRadius: 10,
        hoverRadius: 4,
        hoverBorderWidth: 3,
      }
    }
  };

  var data1 = {
    labels: labels,
    datasets: [{
      backgroundColor: 'rgba(255,255,255,.1)',
      borderColor: 'rgba(255,255,255,.55)',
      pointHoverBackgroundColor: '#fff',
      borderWidth: 2,
      data: [65, 59, 84, 84, 51, 55, 40]
    }]
  };
  var ctx = $('#social-box-chart-1');
  var socialBoxChart1 = new Chart(ctx, {
    type: 'line',
    data: data1,
    options: options
  });

  var data2 = {
    labels: labels,
    datasets: [
      {
        backgroundColor: 'rgba(255,255,255,.1)',
        borderColor: 'rgba(255,255,255,.55)',
        pointHoverBackgroundColor: '#fff',
        borderWidth: 2,
        data: [1, 13, 9, 17, 34, 41, 38]
      }
    ]
  };
  var ctx = $('#social-box-chart-2').get(0).getContext('2d');
  var socialBoxChart2 = new Chart(ctx, {
    type: 'line',
    data: data2,
    options: options
  });

  var data3 = {
    labels: labels,
    datasets: [
      {
        backgroundColor: 'rgba(255,255,255,.1)',
        borderColor: 'rgba(255,255,255,.55)',
        pointHoverBackgroundColor: '#fff',
        borderWidth: 2,
        data: [78, 81, 80, 45, 34, 12, 40]
      }
    ]
  };
  var ctx = $('#social-box-chart-3').get(0).getContext('2d');
  var socialBoxChart3 = new Chart(ctx, {
    type: 'line',
    data: data3,
    options: options
  });

  var data4 = {
    labels: labels,
    datasets: [
      {
        backgroundColor: 'rgba(255,255,255,.1)',
        borderColor: 'rgba(255,255,255,.55)',
        pointHoverBackgroundColor: '#fff',
        borderWidth: 2,
        data: [35, 23, 56, 22, 97, 23, 64]
      }
    ]
  };
  var ctx = $('#social-box-chart-4').get(0).getContext('2d');
  var socialBoxChart4 = new Chart(ctx, {
    type: 'line',
    data: data4,
    options: options
  });



  //Sparkline Charts
  var labels = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];

  var options = {
    legend: {
      display: false,
    },
    scales: {
      xAxes: [{
        display:false,
      }],
      yAxes: [{
        display:false,
      }]
    },
    elements: {
      point: {
        radius: 0,
        hitRadius: 10,
        hoverRadius: 4,
        hoverBorderWidth: 3,
      }
    },
  };

  var data1 = {
    labels: labels,
    datasets: [
      {
        backgroundColor: 'transparent',
        borderColor: $.brandPrimary,
        borderWidth: 2,
        data: [35, 23, 56, 22, 97, 23, 64]
      }
    ]
  };
  var ctx = $('#sparkline-chart-1');
  var sparklineChart1 = new Chart(ctx, {
    type: 'line',
    data: data1,
    options: options
  });

  var data2 = {
    labels: labels,
    datasets: [
      {
        backgroundColor: 'transparent',
        borderColor: $.brandDanger,
        borderWidth: 2,
        data: [78, 81, 80, 45, 34, 12, 40]
      }
    ]
  };
  var ctx = $('#sparkline-chart-2');
  var sparklineChart2 = new Chart(ctx, {
    type: 'line',
    data: data2,
    options: options
  });

  var data3 = {
    labels: labels,
    datasets: [
      {
        backgroundColor: 'transparent',
        borderColor: $.brandWarning,
        borderWidth: 2,
        data: [35, 23, 56, 22, 97, 23, 64]
      }
    ]
  };
  var ctx = $('#sparkline-chart-3');
  var sparklineChart3 = new Chart(ctx, {
    type: 'line',
    data: data3,
    options: options
  });

  var data4 = {
    labels: labels,
    datasets: [
      {
        backgroundColor: 'transparent',
        borderColor: $.brandSuccess,
        borderWidth: 2,
        data: [78, 81, 80, 45, 34, 12, 40]
      }
    ]
  };
  var ctx = $('#sparkline-chart-4');
  var sparklineChart4 = new Chart(ctx, {
    type: 'line',
    data: data4,
    options: options
  });

  var data5 = {
    labels: labels,
    datasets: [
      {
        backgroundColor: 'transparent',
        borderColor: '#d1d4d7',
        borderWidth: 2,
        data: [35, 23, 56, 22, 97, 23, 64]
      }
    ]
  };
  var ctx = $('#sparkline-chart-5');
  var sparklineChart5 = new Chart(ctx, {
    type: 'line',
    data: data5,
    options: options
  });

  var data6 = {
    labels: labels,
    datasets: [
      {
        backgroundColor: 'transparent',
        borderColor: $.brandInfo,
        borderWidth: 2,
        data: [78, 81, 80, 45, 34, 12, 40]
      }
    ]
  };
  var ctx = $('#sparkline-chart-6');
  var sparklineChart6= new Chart(ctx, {
    type: 'line',
    data: data6,
    options: options
  });

});

var Url = (function(w){

  return {
    'get':function(){
      return $('meta[name=base_url]').attr('content');
    }
  }

})(window);

var Loader = (function(w, u){

  return {
    'show':function(){
      $('body').append(`<div class="loader"><i class="fa fa-circle-o-notch fa-spin fa-4x"></i></div>`);
      $('body').css('overflow', 'hidden');
    },
    'hide':function(){
      $('body').css('overflow', 'inherit');
      $('.loader').remove();
    }
  }

})(window, Url);

var Modal = (function(){

  $lmodal = {};

  $lmodal.open = function(url, options = null){
    return Request.get(url).then(function(response){
      if(response.status == true){
        Modal.close();
        $('body').append(response.modal);
        $('#myModal').modal();
        Request.events();
      } else {
        // toastr.error('Error opening popup!');
      }
    });
  };

  $lmodal.close = function(){
    $('#myModal').modal('hide');
    $('#myModal').remove();
  }

  return $lmodal;

})();

var Request = (function(w, u, $, l, m){

  $lrequest = {};

  $lrequest.get = function(url, params = null, options = null){

    return $.ajax({
      url:u.get()+url,
      type:'get',
      dataType: 'json',
      beforeSend:function(){
        l.show();
      },
      success:function(response){
        console.log(response);
      },
      complete:function(){
        l.hide();
      },
      error: function(jqXHR, textStatus, errorThrown) {
                if(typeof(jqXHR.responseJSON) != 'undefined') {
                toastr.error(jqXHR.responseJSON.message);
        }
            }
    });
  };

  $lrequest.post = function(url, params = null, options = null){

    return $.ajax({
      url:u.get()+url,
      type:'post',
      data:params,
      processData:false,
      contentType:false,
      dataType: 'json',
      beforeSend:function(){
        l.show();
      },
      success:function(response){
        if(response.status == false) {
          toastr.error(response.message);
        } else {
          toastr.success(response.message);
        }
      },
      complete:function(){
        l.hide();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        if(typeof(jqXHR.responseJSON) != 'undefined') {
                toastr.error(jqXHR.responseJSON.message);
        }
            }
    });
  };

  $lrequest.events = function(){
    $('form.ajax-submit').unbind().on('submit', function(e){
      e.preventDefault();

      var validated = true;

      if(!$(this).parsley({
        errorsContainer: function (ParsleyField) {
          return ParsleyField.$element.closest('div');

        },
        errorsWrapper: '<div class="text-danger parsley-error-list col-12 mt-2 mb-0"></div>',
        errorTemplate: '<p class="parsley-error m-0"></p>'
      }).validate()){
        return false;
      }

      var formdata = new FormData($(this)[0]);

      Request.post($(this).attr('action'), formdata).then(function(response){
        if(typeof(response.goto) != 'undefined') {
          window.location.replace(response.goto);
        }
      });
    });

    $('.open-modal').unbind().on('click', function(e){
      e.preventDefault();
      m.open($(this).attr('data-url'));
    });

    $('.change-status').unbind().on('click', function(e){
      Request.get($(this).attr('data-url')).then(function(response){
        if(typeof(response.goto) != 'undefined') {
          window.location.replace(response.goto);
        }
      });
    });
  }

  return $lrequest;

})(window, Url, $, Loader, Modal);
Request.events();