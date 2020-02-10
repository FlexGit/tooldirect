<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?><div class="container">
	<h1><?$APPLICATION->ShowTitle()?></h1>
<div class="greenseparator"></div>

      <div class="row">
        <div class="col-sm-9">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="cart_small_image"></th>
                  <th scope="col" class="cart_item_name">Название</th>
                  <th scope="col" class="cart_item_price">Цена, руб</th>
					<th scope="col" class="cart_item_zakaz">Заказ</th>
                  <th scope="col" class="cart_item_itog">Сумма, руб</th>
					<th scope="col" class="delete_item"></th>
                </tr>
              </thead>
              <tr>
				  <td class="cart_small_image"><img src="/bitrix/templates/tooldirect/images/product-01.jpg" alt=""></td>
                <td class="cart_item_name">Сверло глухое Z=2+2 5x35x70 S=10x20 L, , шт</td>
                <td class="cart_item_price">500</td>
                <td  class="cart_item_zakaz"><input type="number" placeholder="199"></td>
                <td class="cart_item_itog">500 000</td>
                <td>
                  <div class="delete_item"><i class="fa fa-times"></i></div>
                </td>

              </tr>
              <tr>
                <td class="cart_small_image"><img src="/bitrix/templates/tooldirect/images/product-01.jpg" alt=""></td>
                <td class="cart_item_name">Сверло глухое Z=2+2 5x35x70 S=10x20 L, , шт</td>
                <td class="cart_item_price">500</td>
                <td  class="cart_item_zakaz"><input type="number" placeholder="199"></td>
                <td class="cart_item_itog">500 000</td>
                <td>
                  <div class="delete_item"><i class="fa fa-times"></i></div>
                </td>

              </tr>
              <tr>
                <td class="cart_small_image"><img src="/bitrix/templates/tooldirect/images/product-01.jpg" alt=""></td>
                <td class="cart_item_name">Сверло глухое Z=2+2 5x35x70 S=10x20 L, , шт</td>
                <td class="cart_item_price">500</td>
                <td class="cart_item_zakaz"><input type="number" placeholder="199"></td>
                <td class="cart_item_itog">500 000</td>
                <td>
                  <div class="delete_item"><i class="fa fa-times"></i></div>
                </td>

              </tr>
            </table>
          </div>
        </div>
        <div class="col-sm-3">
          <table class="table">
            <thead>
              <tr>
              
                <th scope="col">Общий итог корзины</th>
                <th scope="col">Сумма, руб</th>
              </tr>
            </thead>
            <tr>
              <td class="cart_total">Итого, руб</td>
              <td class="cart_total_price">500</td>
            </tr>
            <tr>
              <td class="cart_total">Скидка </td>
              <td class="cart_total_price">10%</td>
            </tr>
            <tr>
              <td class="cart_total">Доставка, руб</td>
              <td class="cart_total_price">0</td>
            </tr>
            <tr>
              <td class="cart_total">ИТОГО, руб</td>
              <td class="cart_total_price">500 000</td>
            </tr>
          </table>
         <a href="#" class="product__menu-button float-right">Оформить заказ</a>
        </div>

      </div>


<section id="cart_contact_form">
  <h2>Корзина</h2>
  <div class="greenseparator"></div>

  <form>
    <div class="row vidacha_flex">
      <div class="col">
        <div class="form-group">
          <label for="yourname">Как вас зовут</label>
        <input type="text" class="form-control" id="yourname" placeholder="Константин Константинопольский">
      </div>
      <div class="form-group">
        <label for="yourname">Ваш телефон</label>
        <input type="phone" class="form-control" id="yourname" placeholder="+7(XXX)XXX-XX-XX">
</div>
<div class="form-group">
    <label for="yourname">Ваша почта</label>
    <input type="mail" class="form-control" id="yourname" placeholder="konstantin@mail.ru">
</div>
<div class="form-group">
    <label for="yourname">Ваш адрес</label>
    <input type="phone" class="form-control" id="yourname" placeholder="070589 Москва, ул. Ленина 15 дом 21">
</div>
      </div>
      <div class="col">
          <div class="form-group">
              <label for="exampleFormControlSelect1">Выберите удобный способ оплаты </label>
              <select class="form-control" id="exampleFormControlSelect1">
                <option>Оплата при получении</option>
                <option>Оплата наложенным платежом</option>
                <option>Оплата по безналичному рассчету</option>
                <option>Оплата WebMoney</option>
                
              </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Выберите удобный способ доставки </label>
                <select class="form-control" id="exampleFormControlSelect1">
                  <option>Оплата при получении</option>
                  <option>Оплата наложенным платежом</option>
                  <option>Оплата по безналичному рассчету</option>
                  <option>Оплата WebMoney</option>
                  
                </select>
              </div>
      </div>
      <div class="col">
          <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck1">
              <label class="custom-control-label" for="customCheck1">Я ЮРИДИЧЕСКОЕ ЛИЦО</label>
            </div>
            <div class="form-group">
                <label for="yourname">Название компании</label>
              <input type="text" class="form-control" id="yourname" placeholder="">
            </div>
    <a href="#" class="product__menu-button float-right">Загрузить документы</a>

      </div>
    </div>
  </form>
</section>


      <div class="greenrow">
        <div>
          <h4>Не нашли конкретный инструмент?</h4>
          <h5>оставьте заявку — мы ответим вам в течение дня</h5>
        </div>
        <button class="buttonh4" data-toggle="modal" data-target="#exampleModalCenter">
          Заказать инструмент
        </button>
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
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>