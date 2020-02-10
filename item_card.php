<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Карточка товара");
?>
<div class="container">
    <style>
.footer__submit {
      padding: 15px;
    margin-left: -5px;
}
.footer__input {
  
    width: 100%;
    max-width: 500px;
    margin-bottom: 20px;
}

#soputstvuyshie {
    margin-bottom: 25px;
    padding-top: 28px;
}
        .col-sm-4 img {
            max-width: 100%;
        }
		.aval {color: #3CAA37;}
        .product__item {
            width: 24%;
        }

        .product__price-box {
            position: relative;
            bottom: 13px;
            right: 10px;
            left: 0;
            height: 40px;
            text-align: left;
            padding-top: 14px;
            margin: 20px 0;
        }

        .textjustify {
            display: flex;
            justify-content: space-around;
            font-family: Montserrat;
            font-style: normal;
            font-weight: 500;
            font-size: 12px;
            line-height: 15px;
            /* identical to box height */
            margin: 30px 0;
            text-align: center;
        }
		.textbetween {justify-content: space-between; display:flex;padding: 16px;}
	.product__item .textjustify {justify-content: center;}
		.product__item .product__price {padding-left:0;}
.product__item .product__price,.product__item .product__old-price {
    padding-left: 0;
    width: 50%;
    margin: 0 auto;
    display: block;
}
        @media screen and (max-width: 600px) {
            .product__item {
                width: 100%;
            }
.tm__slider-box {
    display: block;
}
        }
    </style>
    <h1>Сверла чашечные для электроинструмента Rotis</h1>
    <div class="greenseparator"></div>
    <section id="opisanie_item">
        <div class="row" style="align-items: flex-start;">
            <div class="col-sm-4" style="max-width: 450px; width:100%;">
                <img src="http://tool-direct.ru/bitrix/templates/tooldirect/images/product-01.jpg" alt="">
                <div class="row rowmobile">
                    <div class="col-sm-4"><img
                            src="http://tool-direct.ru/bitrix/templates/tooldirect/images/product-01.jpg" alt=""></div>
                    <div class="col-sm-4"><img
                            src="http://tool-direct.ru/bitrix/templates/tooldirect/images/product-01.jpg" alt=""></div>
                    <div class="col-sm-4"><img
                            src="http://tool-direct.ru/bitrix/templates/tooldirect/images/product-01.jpg" alt=""></div>
                </div>
            </div>

            <div class="col-sm-5">

                <p>Tideway – огромный промышленный комплекс, расположенный в Ханьчжоу на западе Китая. Фабрика
                    занимается производством большого объёма режущего инструмента высокого качества. Продукция
                    данного завода уже давно знакома Российским потребителям под различными торговыми марками
                    Европейских производителей, которые часть продукции размещают в Китае.</p>


                <h4>Технические характеристики</h4>
                <p> <b>Код товара</b> A2FLX3.12 </p>
                <p> <b>Серия</b> А </p>
                <p> <b>Рабочий диаметр (D), мм</b> 3,175 </p>
                <p><b> Рабочая высота (I), мм</b> 12 </p>
                <p> <b>Диаметр хвостовика (S), мм </b>3,175 </p>
				<p style="padding-bottom: 20px;"><b>Общая длина (L), мм</b> 38 </p>
<div class="textflex">
                        <img src="/bitrix/templates/tooldirect/images/youtube.svg" alt="" class="product__video">
                        <img src="/images/pdf.png" style="width: 38px; height:38px;" alt="" class="product__basket">
                    </div>

</div>
            <div class="smalldescription col-sm-3">
                <p><b>Бренд:</b> Pilana</p>
                <p><b>Артикул: </b>LC180170005L</p>
                <div class="product__price-box">
                    <div class="product__old-price">130 000</div>
                    <div class="product__price">125 500 <span class="rub">руб</span></div>
                </div>
                <div class="flexjustify"><input style="height: 50px;" type="number" name="quantity" placeholder="199">
                    <div>
                        <div class="dealer__buttons gtr">
                            <a href="#" class="product__menu-button">купить</a>
                            <a href="#" class="product__menu-button whitebtn">купить в 1 клик</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <p>Tideway – огромный промышленный комплекс, расположенный в Ханьчжоу на западе Китая. Фабрика
        занимается производством большого объёма режущего инструмента высокого качества. Продукция
        данного завода уже давно знакома Российским потребителям под различными торговыми марками
        Европейских производителей, которые часть продукции размещают в Китае. </p>

    <p>Также компания Tideway является крупнейшим импортёром в Азии твёрдого сплава именно
        Люксембургской фабрики Ceratizit, что делает их продукцию значимо отличной от других
        производителей в данном регионе.</p>
    <p>Компания Тулдирект представляет продукцию завода под их собственным брендом. Без двойных
        логистических перемещений из Азии в Европу, затем из Европы в Россию; без многих наценок
        различных заинтересованных сторон. Мы рады предложить качественную продукцию завода со склада в
        Москве по самым справедливым ценам на рынке.</p>





    <section id="soputstvuyshie">
        <h3>С этим товаром покупают </h3>
        <div class="tm__slider-box">
            <div class="tm__slider js-tm-slider owl-carousel owl-theme owl-loaded owl-drag">

                <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"></button><button
                        type="button" role="presentation" class="owl-next"></button></div>

            </div>






            <div class="product__items-box flex">
                <div class="product__items js-product-items product-items-01 is-visible">
                    <!-- product__item -->
                    <div class="product__item">

                        <div class="product__discount">10%</div>
                        <div class="product__item-row">
                            <img src="/bitrix/templates/tooldirect/images/youtube.svg" alt="" class="product__video">
                            <div class="product__img-box">
                                <img src="/bitrix/templates/tooldirect/images/product-01.jpg" alt="">
                            </div>
                            <img src="/images/pdf.png" style="width: 38px; height:38px;" alt=""
                                class="product__basket">
                        </div>
                        <div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ
                        </div>
                        <div class="textbetween">
                            <div>код товара: 1256623</div>
                            <div class="aval">товар в наличии</div>
                        </div>
                        <div class="product__price-box">
                            <div class="product__old-price">130 000</div>
                            <div class="product__price">125 500 <span>руб/шт</span></div>
                            <div class="textjustify"><input style="height: 50px;" type="number" name="quantity"
                                    placeholder="199">
                                <div>
                                    <div class="dealer__buttons gtr">
                                        <a href="#" class="product__menu-button">купить</a>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> <!-- product__item -->
                 <!-- product__item -->
                 <div class="product__item">

                    <div class="product__discount">10%</div>
                    <div class="product__item-row">
                        <img src="/bitrix/templates/tooldirect/images/youtube.svg" alt="" class="product__video">
                        <div class="product__img-box">
                            <img src="/bitrix/templates/tooldirect/images/product-01.jpg" alt="">
                        </div>
                        <img src="/images/pdf.png" style="width: 38px; height:38px;" alt=""
                            class="product__basket">
                    </div>
                    <div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ
                    </div>
                    <div class="textbetween">
                        <div>код товара: 1256623</div>
                        <div class="aval">товар в наличии</div>
                    </div>
                    <div class="product__price-box">
                        <div class="product__old-price">130 000</div>
                        <div class="product__price">125 500 <span>руб/шт</span></div>
                        <div class="textjustify"><input style="height: 50px;" type="number" name="quantity"
                                placeholder="199">
                            <div>
                                <div class="dealer__buttons gtr">
                                    <a href="#" class="product__menu-button">купить</a>

                                </div>

                            </div>
                        </div>
                    </div>
                </div> <!-- product__item -->
                 <!-- product__item -->
                 <div class="product__item">

                    <div class="product__discount">10%</div>
                    <div class="product__item-row">
                        <img src="/bitrix/templates/tooldirect/images/youtube.svg" alt="" class="product__video">
                        <div class="product__img-box">
                            <img src="/bitrix/templates/tooldirect/images/product-01.jpg" alt="">
                        </div>
                        <img src="/images/pdf.png" style="width: 38px; height:38px;" alt=""
                            class="product__basket">
                    </div>
                    <div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ
                    </div>
                    <div class="textbetween">
                        <div>код товара: 1256623</div>
                        <div class="aval">товар в наличии</div>
                    </div>
                    <div class="product__price-box">
                        <div class="product__old-price">130 000</div>
                        <div class="product__price">125 500 <span>руб/шт</span></div>
                        <div class="textjustify"><input style="height: 50px;" type="number" name="quantity"
                                placeholder="199">
                            <div>
                                <div class="dealer__buttons gtr">
                                    <a href="#" class="product__menu-button">купить</a>

                                </div>

                            </div>
                        </div>
                    </div>
                </div> <!-- product__item -->
                 <!-- product__item -->
                 <div class="product__item">

                    <div class="product__discount">10%</div>
                    <div class="product__item-row">
                        <img src="/bitrix/templates/tooldirect/images/youtube.svg" alt="" class="product__video">
                        <div class="product__img-box">
                            <img src="/bitrix/templates/tooldirect/images/product-01.jpg" alt="">
                        </div>
                        <img src="/images/pdf.png" style="width: 38px; height:38px;" alt=""
                            class="product__basket">
                    </div>
                    <div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ
                    </div>
                    <div class="textbetween">
                        <div>код товара: 1256623</div>
                        <div class="aval">товар в наличии</div>
                    </div>
                    <div class="product__price-box">
                        <div class="product__old-price">130 000</div>
                        <div class="product__price">125 500 <span>руб/шт</span></div>
                        <div class="textjustify"><input style="height: 50px;" type="number" name="quantity"
                                placeholder="199">
                            <div>
                                <div class="dealer__buttons gtr">
                                    <a href="#" class="product__menu-button">купить</a>

                                </div>

                            </div>
                        </div>
                    </div>
                </div> <!-- product__item -->
                   
                  

                </div>
            </div>

    </section>


    <div class="greenrow">
        <div>
            <h4>Не нашли конкретный инструмент?</h4>
            <h5>оставьте заявку — мы ответим вам в течение дня</h5>
        </div>
        <a href="#" class="order__button button button--white  button--h64 button--fz24">Заказать инструмент</a>
    </div>







    <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle">не нашли нужного инструмента? закажите у нас!
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="yourname">Как вас зовут</label>
                                    <input type="text" class="form-control" id="yourname"
                                        placeholder="Константин Константинопольский">
                                </div>
                                <div class="form-group">
                                    <label for="yourname">Ваш телефон</label>
                                    <input type="phone" class="form-control" id="yourname"
                                        placeholder="+7(XXX)XXX-XX-XX">
                                </div>


                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="yourname">Ваша почта</label>
                                    <input type="mail" class="form-control" id="yourname"
                                        placeholder="konstantin@mail.ru">
                                </div>
                                <div class="form-group">
                                    <label for="yourname">Ваш город</label>
                                    <input type="text" class="form-control" id="yourname" placeholder="Москва">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Опишите ваши требования</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                        placeholder="Напишите ваше сообщение тут... "></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Заказать инструмент</button>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>