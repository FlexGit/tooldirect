<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Выдача");
?>
 <link rel='stylesheet' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>
<div class="container">
<style>
h6 {
    padding-left: 16px;
    padding-bottom: 10px;
}
.cube { 
  position:relative;
  width:580px;
  height:20px;
  margin:0 auto;

}
/* positions */
.a, .b, .c, .d {
  position:absolute;
  width:50%;
  height:100%;
  left:0px;
  z-index:222;
border-radius: 15px;
}
.a:before, .b:before, .c:before, .d:before, .a:after, .b:after {
  content:'';
  position:absolute;
  top:0px;
  left:0px;
  width:580px;
  height:20px;
}
.a:before, .b:before, .c:before, .d:before {
  z-index:111;
}
.a:after, .b:after {
  z-index:333;
}
.b {
  top:0px;

}
.c {
  top:0px;

}
.d {
 
}
/* colors */
.a, .b {
  background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(116,198,43,0.8)), to(rgba(116,198,43,0.8)));
  background-image: -webkit-linear-gradient(top, rgba(116,198,43,0.8), rgba(116,198,43,0.8));
  background-image:    -moz-linear-gradient(top, rgba(116,198,43,0.8), rgba(116,198,43,0.8));
  background-image:      -o-linear-gradient(top, rgba(116,198,43,0.8), rgba(116,198,43,0.8));
  background-image:         linear-gradient(to bottom, rgba(116,198,43,0.8), rgba(116,198,43,0.8));
  background-repeat:no-repeat;
		background: #3CAA37;
  background-size:100% 100%;
  background-position:0% 0%;
}
.c, .d {
  background-image:-webkit-gradient(linear, left top, left bottom, from(rgba(116,198,43,0.5)), to(rgba(116,198,43,0.5)));
  background-image:-webkit-linear-gradient(top, rgba(116,198,43,0.5), rgba(116,198,43,0.5));
  background-image:   -moz-linear-gradient(top, rgba(116,198,43,0.5), rgba(116,198,43,0.5));
  background-image:     -o-linear-gradient(top, rgba(116,198,43,0.5), rgba(116,198,43,0.5));
  background-image:        linear-gradient(to bottom, rgba(116,198,43,0.5), rgba(116,198,43,0.5));
  background-repeat:no-repeat;
  background-size:100% 100%;
  background-position:0% 0%;
border-radius: 15px;
background: #3CAA37;
}
	.output_number {font-family: Montserrat;
font-style: normal;
font-weight: 500;
font-size: 18px;
		margin-left: 38%;
		position: relative;
line-height: 22px;
text-align: right;
background: #E5E5E5;
		padding: 5px 23px;
		width: 80px;
		margin-bottom:31px;
color: #828282;
		text-align:center;
	}
	.output_number_after {
position: absolute;
width: 16px;
height: 16px;
		bottom:-8px;
		left:50%;
		margin-left:-8px;
background: #E5E5E5;
transform: rotate(45deg);
	}
.c:before {
 
}
.a:before, .b:before, .c:before, .d:before {
  background-color:rgba(0,0,0,0.05);
border-radius: 15px;
}
.a:after {
  background-image:-webkit-gradient(linear, left top, left bottom, from(rgba(0,0,0,0.07)), to(rgba(0,0,0,0)));
  background-image:-webkit-linear-gradient(top, rgba(0,0,0,0.07), rgba(0,0,0,0));
  background-image:   -moz-linear-gradient(top, rgba(0,0,0,0.07), rgba(0,0,0,0));
  background-image:     -o-linear-gradient(top, rgba(0,0,0,0.07), rgba(0,0,0,0));
  background-image:        linear-gradient(to bottom, rgba(0,0,0,0.07), rgba(0,0,0,0));
}
.b:after {
  background-image:-webkit-gradient(linear, left top, left bottom, from(rgba(255,255,255,0.1)), to(rgba(255,255,255,0.25)));
  background-image:-webkit-linear-gradient(top, rgba(255,255,255,0.1), rgba(255,255,255,0.25));
  background-image:   -moz-linear-gradient(top, rgba(255,255,255,0.1), rgba(255,255,255,0.25));
  background-image:     -o-linear-gradient(top, rgba(255,255,255,0.1), rgba(255,255,255,0.25));
  background-image:        linear-gradient(to bottom, rgba(255,255,255,0.1), rgba(255,255,255,0.25));
}
/* jQuery stuff */
#slider-range-min {
    position: absolute;
    width: 580px;
    left: 0;
    top: 9px;
    margin: 0px;
    z-index: 999;

}
.ui-slider {
  height:1px;
  border:none;
  background:transparent;
 
}
.ui-slider:before, .ui-slider:after {
  content:'|||||||||';
  position:absolute;
  left:2px;
  width:100%;
  font-size:15px;
  font-weight:300;
  color:#fff;
  letter-spacing:60px;
  text-shadow:1px 1px 0px rgba(255,255,255,0.2);
}
.ui-slider:before {
  top:-0.2rem;
}
.ui-slider:after {
  bottom:-0.2rem;
}
.ui-slider-range {background:transparent;}
.ui-slider .ui-slider-handle {
  top:-17px;
  width:36px;
  height:36px;
  margin-left:-15px;
  padding-left:4px;
  border:none;
  background:green;
  border-radius:50%;
  text-align:center;
  
  
  color:rgba(0,0,0,0.5);
  text-decoration:none;
  letter-spacing:3px;
  cursor:pointer;
  text-shadow:1px 1px 2px rgba(255,255,255,1);
  -webkit-box-shadow:1px 1px 8px rgba(0,0,0,0.3);
  -moz-box-shadow:   1px 1px 8px rgba(0,0,0,0.3);
  box-shadow:        1px 1px 8px rgba(0,0,0,0.3);
}
.ui-slider .ui-slider-handle:focus {
  outline:none;
}
/* typo */

#amount {
  position:relative;
  display:inline-block;
  padding-bottom:5rem;
  text-align:center;
  font-weight:800;
  font-size:4rem;
  color:#529e0e;
  background:transparent;
  border:none;
}
#amount:focus {outline:none;}



	.rub {padding-right: 0;}
	</style>
  <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">

          <div class="vidacha_h2">
            Фильтр по типу товара, свернутый:
          </div>
          <div>

            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample1"
              aria-expanded="false" aria-controls="collapseExample1">
              Выберите тип товара
            </button>
          </div>
          <div class="collapse" id="collapseExample1">
            <div class="card card-body">
              <a href="">
                <div class="choose_panel active_choice">Тип товара номер один</div>
              </a>
              <a href="">
                <div class="choose_panel"> Еще какой-то тип товара, самый длинный и лучший </div>
              </a>
              <a href="">
                <div class="choose_panel"> Короткий тип товара </div>
              </a>
              <a href="">
                <div class="choose_panel">Еще короче </div>
              </a>
              <a href="">
                <div class="choose_panel">Ну и просто, чтобы было </div>
              </a>
            </div>
          </div>
        </div>
  <div class="col-md-3">

        </div>
      </div>

      <div class="vidacha_flex">
        <a href="">
          <div class="filter_param">Диаметр</div>
        </a>
        <a href="">
          <div class="filter_param active">Рабочая часть</div>
        </a>
        <a href="">
          <div class="filter_param ">Общая длина</div>
        </a>
        <a href="">
          <div class="filter_param">Радиус</div>
        </a>
        <a href="">
          <div class="filter_param">Хвостовик</div>
        </a>
        <a href="">
          <div class="filter_param">Материал </div>
        </a>
        <a href="">
          <div class="add_filter">+ </div>
        </a>
      </div>
      <section class="green_flex_3_col">
        <div class="row no-gutters">

          <div class="col-sm-4 flex">
            <p>Рабочая часть №1 </p>
            <input type="text" placeholder="23">
          </div>
          <div class="col-sm-4 flex second_item">
            <p>Рабочая часть №2 </p>
            <input type="text" placeholder="">
          </div>
          <div class="col-sm-4 flex">
            <p>Рабочая часть №3 </p>
            <input type="text" placeholder="">
          </div>
        </div>

      </section>
      <section id="range_filter">
		  <h2 style="margin-bottom: 50px;">Диаметр, мм: </h2>
        <div class="row">
          <div class="col-sm-6">
            <div class="row" style="display: flex; align-items: flex-end;">
              <div class="col-sm-1"><div class="plus_minus">-</div></div>


            <div class="col-sm-10">
				<div id="contentw">
					<div class="output_number">38<span class="output_number_after"></span></div>
  <div class="cube">
    <div class="a" style="width: 38%;"></div>
    <div class="b" style="width: 38%;"></div>
    <div class="c" style="width: 38%;"></div>
    <div class="d" style="width: 38%;"></div>
    <div id="slider-range-min" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min" style="width: 38%;"></div><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 38%;"></span></div>
  </div>


</div></div>
            <div class="col-sm-1">
  <div class="plus_minus">+</div>
            </div>
          </div>
		  </div>
           <div class="col-sm-6"> </div>
    </div>

    </section>
    <section id="checkbox_filter">
      <div class="row">
        <div class="col-md-6">

          <div class="vidacha_h2">
            Фильтр без заголовка
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="button-group">
                <button type="button" class="btn btn-default btn-sm dropdown-toggle"
                  data-toggle="dropdown">Материал<span class="glyphicon glyphicon-cog"></span> <span
                    class="caret"></span></button>
                <ul class="dropdown-menu">

                  <li><a href="#" class="small" data-value="option1" tabIndex="-1">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Древесина <div class="star-rating"
                            title="70%" style="margin-top:0;">
                            <div class="back-stars">
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>

                              <div class="front-stars" style="width: 70%">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                              </div>
                            </div>
                          </div> </label>
                      </div>
                    </a></li>
                  <li><a href="#" class="small" data-value="option2" tabIndex="-1">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck2" checked>
                        <label class="custom-control-label" for="customCheck2">Тонкий пропил древесины <div
                            class="back-stars">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>

                            <div class="front-stars" style="width: 20%">
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                          </div>
                        </label>
                      </div>
                    </a></li>
                  <li><a href="#" class="small" data-value="option3" tabIndex="-1">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck3">
                        <label class="custom-control-label" for="customCheck3">МДФ <div class="back-stars">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>

                            <div class="front-stars" style="width: 100%">
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                          </div>
                        </label>
                      </div>
                    </a></li>
                  <li><a href="#" class="small" data-value="option4" tabIndex="-1">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck4">
                        <label class="custom-control-label" for="customCheck4">ДСП <div class="back-stars">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>

                            <div class="front-stars" style="width: 70%">
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                          </div>
                        </label>
                      </div>
                    </a></li>
                  <li><a href="#" class="small" data-value="option5" tabIndex="-1">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck5">
                        <label class="custom-control-label" for="customCheck5">Фанера<div class="back-stars">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>

                            <div class="front-stars" style="width: 70%">
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                          </div></label>
                      </div>
                    </a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">

          <div class="vidacha_h2">
            Фильтр с заголовком
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="button-group">
                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Радиус<span
                    class="glyphicon glyphicon-cog"></span> <span class="caret"></span>
                  <ul class="dropdown-menu">
                    <h6>Радиус №1</h6>
                    <li><a href="#" class="small" data-value="option1" tabIndex="-1">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="customCheck1">
                          <label class="custom-control-label" for="customCheck1">xx - xx мм (<span
                              class="number_items">5</span>)</label>
                        </div>
                      </a></li>
                    <li><a href="#" class="small" data-value="option2" tabIndex="-1">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="customCheck2" checked>
                          <label class="custom-control-label" for="customCheck2">yy - yy мм (<span
                              class="number_items">1</span>) </label>
                        </div>
                      </a></li>
                    <h6>Радиус №2</h6>
                    <li><a href="#" class="small" data-value="option3" tabIndex="-1">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="customCheck3">
                          <label class="custom-control-label" for="customCheck3">xx - xx мм</label>
                        </div>
                      </a></li>

                  </ul>
                </button>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="text_block_flex">
      <div class="row flex">
        <div class="col-md-2">
 <img src="http://tool-direct.ru/bitrix/templates/tooldirect/images/product-01.jpg" alt="">


        </div>
        <div class="col-md-8">
          <h5>Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</h5>
			<div style="display:flex;justify-content: flex-start;">
				<img src="/bitrix/templates/tooldirect/images/youtube.svg" alt="" class="product__video" style="margin-right: 20px;">
                           
                            <img src="/bitrix/templates/tooldirect/images/product-basket.svg" alt="" class="product__basket">
                        </div>
          <p>Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной
            "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую
            коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. </p>
          <p>Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный
            дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х
            годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых
            используется Lorem Ipsum.</p>


        </div>
        <div class="col-md-2">
          <div class="price">12 500 <span class="rub">руб.</span></div>
           <a href="#" class="product__menu-button" style="text-align:center;">заказать</a>
        </div>
      </div>
    </section>
    </div>
 
<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
<script>
 $(function() {
    $( "#slider-range-min" ).slider({
      range: "min",
      value: 50,
      min: 0,
      max: 100,
      slide: function( event, ui ) {
        $( "#amount" ).val(ui.value);
        $(".a, .b, .c, .d").width(ui.value + "%");
      }
    });
    $(".ui-slider-handle").text("");
    $( "#amount" ).val(  $( "#slider-range-min" ).slider( "value") );
  });
</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>