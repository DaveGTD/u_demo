<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>TermX</title>

  <link rel="stylesheet" href="bower_components_upper/bootstrap/dist/css/bootstrap.min.css" id="bt-theme">
  <link rel="stylesheet" href="bower_components_upper/bootstrap-select/dist/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="bower_components_upper/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css">
  <link rel="stylesheet" href="bower_components/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css">
  <link rel="stylesheet" href="bower_components/selectize/dist/css/selectize.bootstrap3.css">

  <link rel="stylesheet" href="query-builder.default.css" id="qb-theme">

  <link rel="stylesheet" href="http://mistic100.github.io/jQuery-QueryBuilder/assets/flags/flags.css">
  <style>
    .flag { display: inline-block; }
  </style>
</head>

<body>

<div class="container">
  <div class="col-md-12 col-lg-10 col-lg-offset-1">
    <div class="page-header">
      <a class="pull-left" href="https://github.com/mistic100/jQuery-QueryBuilder">
        <!-- <img src="https://assets.github.com/images/icons/emoji/octocat.png" width=48px height=48px> -->
        <img src="png_1.png" width=120px height=50px>
        <br>
      </a>
       <h1></h1>
    </div>

    <div class="alert alert-info alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      You must execute <code>bower install</code> in the example directory to run this demo.
    </div>

    <div class="well well-sm">
      <label>Theme:</label>
      <div class="btn-group">
        <button class="btn btn-primary btn-sm change-theme" data-qb="query-builder.default.css" data-bt="bower_components_upper/bootstrap/dist/css/bootstrap.min.css">Default</button>
        <button class="btn btn-primary btn-sm change-theme" data-qb="query-builder.dark.css" data-bt="bower_components_upper/bootstrap/dist/css/bootstrap.min.css">Dark</button>
      </div>

      <label>Language:</label>
      <select name="language" class="selectpicker show-tick show-menu-arrow" data-width="auto">
        <option value="sq" data-icon="flag flag-al">Albanian</option>
        <option value="ar" data-icon="flag flag-ar">Arabic</option>
        <option value="az" data-icon="flag flag-az">Azerbaijani</option>
        <option value="cs" data-icon="flag flag-cs">Czech</option>
        <option value="de" data-icon="flag flag-de">German</option>
        <option value="da" data-icon="flag flag-dk">Danish</option>
        <option value="en" data-icon="flag flag-gb" selected>English</option>
        <option value="es" data-icon="flag flag-es">Spanish</option>
        <option value="fr" data-icon="flag flag-fr">French</option>
        <option value="it" data-icon="flag flag-it">Italian</option>
        <option value="fa-IR" data-icon="flag flag-ir">Farsi</option>
        <option value="nl" data-icon="flag flag-nl">Dutch</option>
        <option value="no" data-icon="flag flag-no">Norwegian</option>
        <option value="pl" data-icon="flag flag-pl">Polish</option>
        <option value="pt-PT" data-icon="flag flag-pt-PT">Portuguese</option>
        <option value="pt-BR" data-icon="flag flag-pt-BR">Brazilian Portuguese</option>
        <option value="ro" data-icon="flag flag-ro">Romanian</option>
        <option value="ru" data-icon="flag flag-ru">Russian</option>
        <option value="tr" data-icon="flag flag-tr">Turkish</option>
        <option value="ua" data-icon="flag flag-ua">Ukrainian</option>
        <option value="zh-CN" data-icon="flag flag-zh-CN" >Simplified Chinese</option>
      </select>
    </div>

    <div id="builder"></div>

    <div class="btn-group">
      <button class="btn btn-danger reset">Reset</button>
      <button class="btn btn-warning set-filters" data-toggle="tooltip" title="Adds a filter 'New filter' and removes 'Coordinates', 'State', 'BSON'" data-container="body" data-placement="bottom">Set filters</button>
    </div>

    <!--
    <div class="btn-group">
      <button class="btn btn-default" disabled>Set:</button>
      <button class="btn btn-success set">From JSON</button>
      <button class="btn btn-success set-mongo">From MongoDB</button>
      <button class="btn btn-success set-sql">From SQL</button>
    </div>

    <div class="btn-group">
      <button class="btn btn-default" disabled>Get:</button>
      <button class="btn btn-primary parse-json">JSON</button>
      <button class="btn btn-primary parse-sql" data-stmt="false">SQL</button>
      <button class="btn btn-primary parse-sql" data-stmt="question_mark">SQL statement</button>
      <button class="btn btn-primary parse-mongo">MongoDB</button>
    </div>
    -->

    <div id="result" class="hide">
      <h3>Output</h3>
      <pre></pre>
    </div>
  </div>
</div>

<script src="bower_components_upper/jquery/dist/jquery.js"></script>
<script src="bower_components_upper/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components_upper/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="bower_components_upper/bootbox/bootbox.js"></script>
<script src="bower_components/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js"></script>
<script src="bower_components/selectize/dist/js/standalone/selectize.min.js"></script>
<script src="bower_components_upper/jquery-extendext/jQuery.extendext.min.js"></script>
<script src="bower_components_upper/sql-parser/browser/sql-parser.js"></script>
<script src="bower_components_upper/doT/doT.js"></script>

<script src="query-builder.js"></script>



<?php 
$something = 20;
?>

<script>

// window.onload = log;
function log()
{
	console.log("Test Message: " + <?php echo $something ?>);
}

</script>



<script>
$('[data-toggle="tooltip"]').tooltip();

var $b = $('#builder');

var options = {
  allow_empty: true,

  default_filter: 'name',
  sort_filters: true,

  optgroups: {
    core: {
      en: 'Core',
      fr: 'Coeur'
    }
  },

  plugins: {
    'bt-tooltip-errors': { delay: 100},
    'sortable': null,
    'filter-description': { mode: 'bootbox' },
    'bt-selectpicker': null,
    'unique-filter': null,
    'bt-checkbox': { color: 'primary' },
    'invert': null
  },

  // standard operators in custom optgroups
  operators: [
    {type: 'equal',            optgroup: 'basic'},
    {type: 'not_equal',        optgroup: 'basic'},
    {type: 'in',               optgroup: 'basic'},
    {type: 'not_in',           optgroup: 'basic'},
    {type: 'less',             optgroup: 'numbers'},
    {type: 'less_or_equal',    optgroup: 'numbers'},
    {type: 'greater',          optgroup: 'numbers'},
    {type: 'greater_or_equal', optgroup: 'numbers'},
    {type: 'between',          optgroup: 'numbers'},
    {type: 'not_between',      optgroup: 'numbers'},
    {type: 'begins_with',      optgroup: 'strings'},
    {type: 'not_begins_with',  optgroup: 'strings'},
    {type: 'contains',         optgroup: 'strings'},
    {type: 'not_contains',     optgroup: 'strings'},
    {type: 'ends_with',        optgroup: 'strings'},
    {type: 'not_ends_with',    optgroup: 'strings'},
    {type: 'is_empty'     },
    {type: 'is_not_empty' },
    {type: 'is_null'      },
    {type: 'is_not_null'  }
  ],

  filters: [

  {
    id: 'Custom',
    label: 'Custom',
    type: 'string',
    input: 'select',
    optgroup: 'core',
    placeholder: 'Select something',
    values: {
      'eur': 'Europe',
      'asia': 'Asia',
      'oce': 'Oceania',
      'afr': 'Africa',
      'na': 'North America',
      'sa': 'South America'
    },
    operators: ['equal', 'not_equal', 'is_null', 'is_not_null']
  },




  /*
   * basic
   */
  {
    id: 'name',
    label: {
      en: 'Name',
      fr: 'Nom'
    },
    type: 'string',
    optgroup: 'core',
    default_value: 'Mistic',
    size: 30,
    unique: true
  },
  /*
   * textarea
   */
  {
    id: 'bson',
    label: 'BSON',
    type: 'string',
    input: 'textarea',
    operators: ['equal'],
    size: 30,
    rows: 3
  },
  /*
   * checkbox
   */
  {
    id: 'category',
    label: 'Category',
    type: 'integer',
    input: 'checkbox',
    optgroup: 'core',
    values: {
      1: 'Books',
      2: 'Movies',
      3: 'Music',
      4: 'Tools',
      5: 'Goodies',
      6: 'Clothes'
    },
    colors: {
      1: 'foo',
      2: 'warning',
      5: 'success'
    },
    operators: ['in', 'not_in', 'equal', 'not_equal', 'is_null', 'is_not_null']
  },
  /*
   * select
   */
  {
    id: 'continent',
    label: 'Continent',
    type: 'string',
    input: 'select',
    optgroup: 'core',
    placeholder: 'Select something',
    values: {
      'eur': 'Europe',
      'asia': 'Asia',
      'oce': 'Oceania',
      'afr': 'Africa',
      'na': 'North America',
      'sa': 'South America'
    },
    operators: ['equal', 'not_equal', 'is_null', 'is_not_null']
  },
  /*
   * Selectize
   */
  {
    id: 'state',
    label: 'State',
    type: 'string',
    input: 'select',
    multiple: true,
    plugin: 'selectize',
    plugin_config: {
      valueField: 'id',
      labelField: 'name',
      searchField: 'name',
      sortField: 'name',
      options: [
        { id: "AL", name: "Alabama" },
        { id: "AK", name: "Alaska" },
        { id: "AZ", name: "Arizona" },
        { id: "AR", name: "Arkansas" },
        { id: "CA", name: "California" },
        { id: "CO", name: "Colorado" },
        { id: "CT", name: "Connecticut" },
        { id: "DE", name: "Delaware" },
        { id: "DC", name: "District of Columbia" },
        { id: "FL", name: "Florida" },
        { id: "GA", name: "Georgia" },
        { id: "HI", name: "Hawaii" },
        { id: "ID", name: "Idaho" }
      ]
    },
    valueSetter: function(rule, value) {
      rule.$el.find('.rule-value-container select')[0].selectize.setValue(value);
    }
  },
  /*
   * radio
   */
  {
    id: 'in_stock',
    label: 'In stock',
    type: 'integer',
    input: 'radio',
    optgroup: 'plugin',
    values: {
      1: 'Yes',
      0: 'No'
    },
    operators: ['equal']
  },
  /*
   * double
   */
  {
    id: 'price',
    label: 'Price',
    type: 'double',
    size: 5,
    validation: {
      min: 0,
      step: 0.01
    },
    data: {
      class: 'com.example.PriceTag'
    }
  },
  /*
   * slider
   */
  {
    id: 'rate',
    label: 'Rate',
    type: 'integer',
    validation: {
      min: 0,
      max: 100
    },
    plugin: 'slider',
    plugin_config: {
      min: 0,
      max: 100,
      value: 0
    },
    onAfterSetValue: function(rule, value) {
      var input = rule.$el.find('.rule-value-container input');
      input.slider('setValue', value);
      input.val(value); // don't know why I need it
    }
  },
  /*
   * placeholder and regex validation
   */
  {
    id: 'id',
    label: 'Identifier',
    type: 'string',
    optgroup: 'plugin',
    placeholder: '____-____-____',
    size: 14,
    operators: ['equal', 'not_equal'],
    validation: {
      format: /^.{4}-.{4}-.{4}$/
    }
  },
  /*
   * custom input
   */
  {
    id: 'coord',
    label: 'Coordinates',
    type: 'string',
    default_value: 'C.5',
    description: 'The letter is the cadran identifier:\
<ul>\
  <li><b>A</b>: alpha</li>\
  <li><b>B</b>: beta</li>\
  <li><b>C</b>: gamma</li>\
</ul>',
    validation: {
      format: /^[A-C]{1}.[1-6]{1}$/
    },
    input: function(rule) {
      var $container = rule.$el.find('.rule-value-container');

      $container.on('change', '[name=coord_1]', function(){
        var h = '';

        switch ($(this).val()) {
          case 'A':
            h = '<option value="-1">-</option> <option value="1">1</option> <option value="2">2</option>';
            break;
          case 'B':
            h = '<option value="-1">-</option> <option value="3">3</option> <option value="4">4</option>';
            break;
          case 'C':
            h = '<option value="-1">-</option> <option value="5">5</option> <option value="6">6</option>';
            break;
        }

        $container.find('[name=coord_2]').html(h).toggle(h!='');
      });

      return '\
      <select name="coord_1" class="form-control"> \
        <option value="-1">-</option> \
        <option value="A">A</option> \
        <option value="B">B</option> \
        <option value="C">C</option> \
      </select> \
      <select name="coord_2" class="form-control" style="display:none;"></select>';
    },
    valueParser: function(rule, value) {
      return rule.$el.find('[name=coord_1]').val()
        +'.'+rule.$el.find('[name=coord_2]').val();
    },
    valueSetter: function(rule, value) {
      if (rule.operator.nb_inputs !== 0) {
        var val = value.split('.');
        rule.$el.find('[name=coord_1]').val(val[0]).trigger('change');
        rule.$el.find('[name=coord_2]').val(val[1]);
      }
    }
  }]
};

// init
$('#builder').queryBuilder(options);

$('#builder').on('afterCreateRuleInput.queryBuilder', function(e, rule) {
    if (rule.filter.plugin == 'selectize') {
        rule.$el.find('.rule-value-container').css('min-width', '200px')
          .find('.selectize-control').removeClass('form-control');
    }
});

// change language
$('[name=language]').selectpicker().on('change', function() {
  var lang = $(this).val();

  var done = function() {
    var rules = $b.queryBuilder('getRules');
    if (!$.isEmptyObject(rules)) {
      options.rules = rules;
    }
    options.lang_code = lang;
    $b.queryBuilder('destroy');
    $('#builder').queryBuilder(options);
  };

  if ($.fn.queryBuilder.regional[lang] === undefined) {
    $.getScript('../dist/i18n/query-builder.' + lang + '.js', done);
  }
  else {
    done();
  }
});

// change theme
$('.change-theme').on('click', function() {
    $('#qb-theme').replaceWith('<link rel="stylesheet" href="' + $(this).data('qb') + '" id="qb-theme">');
    $('#bt-theme').replaceWith('<link rel="stylesheet" href="' + $(this).data('bt') + '" id="bt-theme">');
});

// set rules
$('.set').on('click', function() {
  $('#builder').queryBuilder('setRules', {
    condition: 'AND',
    flags: {
      condition_readonly: true
    },
    rules: [{
      id: 'price',
      operator: 'between',
      value: [10.25, 15.52],
      flags: {
        no_delete: true,
        filter_readonly: true
      },
      data: {
        unit: '€'
      }
    }, {
      id: 'state',
      operator: 'equal',
      value: 'AK'
    }, {
      condition: 'OR',
      flags: {
        no_delete: true
      },
      rules: [{
        id: 'category',
        operator: 'equal',
        value: 2
      }, {
        id: 'coord',
        operator: 'equal',
        value: 'B.3'
      }]
    }]
  });
});

// set rules from MongoDB
$('.set-mongo').on('click', function() {
  $('#builder').queryBuilder('setRulesFromMongo', {
    "$and": [{
      "name": {
        "$regex": "^(?!Mistic)"
      }
    }, {
      "price": { "$gte": 0, "$lte": 100 }
    }, {
      "$or": [{
        "category": 2
      }, {
        "category": { "$in": [4, 5] }
      }]
    }]
  });
});

// set rules from SQL
$('.set-sql').on('click', function() {
  $('#builder').queryBuilder('setRulesFromSQL', 'name NOT LIKE "Mistic%" AND price BETWEEN 100 AND 200 AND (category IN(1, 2) OR rate <= 2)');
});

// reset builder
$('.reset').on('click', function() {
  $('#builder').queryBuilder('reset');
  $('#result').addClass('hide').find('pre').empty();
});

// get rules
$('.parse-json').on('click', function() {
  $('#result').removeClass('hide')
    .find('pre').html(JSON.stringify(
      $('#builder').queryBuilder('getRules', {get_flags: true}),
      undefined, 2
    ));
});

$('.parse-sql').on('click', function() {
  var res = $('#builder').queryBuilder('getSQL', $(this).data('stmt'), false);
  $('#result').removeClass('hide')
    .find('pre').html(
      res.sql + (res.params ? '\n\n' + JSON.stringify(res.params, undefined, 2) : '')
    );
});

$('.parse-mongo').on('click', function() {
  $('#result').removeClass('hide')
    .find('pre').html(JSON.stringify(
      $('#builder').queryBuilder('getMongo'),
      undefined, 2
    ));
});

// set filters
$('.set-filters').on('click', function() {
  $(this).prop('disabled', true);
  $(this).tooltip('hide');

  // add a new filter after 'state'
  $('#builder').queryBuilder('addFilter',
    {
      id: 'new_one',
      label: 'New filter',
      type: 'string'
    },
    'state'
  );

  // remove filter 'coord'
  $('#builder').queryBuilder('removeFilter',
    ['coord', 'state', 'bson'],
    true
  );

  // also available : 'setFilters'
});
</script>

<script>

/*

function myFunction()
{
   var result = $('#builder').queryBuilder('getSQL', $(this).data('stmt'), false);
   // var result = $('#builder').queryBuilder('getSQL', 'question_mark');
   console.log("RESULT: " + JSON.stringify(result));

   var mongo_result = $('#builder').queryBuilder('getMongo');
   console.log("MONGO: " JSON.stringify(mongo_result));

}

function postQuery()
{
  var mongo_result = $('#builder').queryBuilder('getMongo');
  // post('B.php', {name: 'Dave'});
  $.post("B.php", {name:"John", time: "3pm"});
}

 
function post(path, params, method)
{
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
         }
    }

    document.body.appendChild(form);
    form.submit();
}

$("#form_B").submit(function() {
    var name = "Dave";
    $('#hidden_query').val(name);
});
*/

function doThis()
{
  var mongo_result = $('#builder').queryBuilder('getMongo');
  document.getElementById("hidden_query").value = JSON.stringify(mongo_result);

};

</script>


<form onsubmit="doThis()" id="form_B" action="B.php" method="POST">
<input type="hidden" name="hidden_query" id="hidden_query" value="something else" />
<input type="submit" value="submit">
</form>


<!--
<button onclick="postQuery()"> Click Me </button> <BR><BR>
-->



</body>
</html>
