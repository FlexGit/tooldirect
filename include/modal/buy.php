<div class="modal" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="buyModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="alert alert-danger hidden" role="alert"></div>
			<div class="alert alert-success hidden" role="alert"></div>
			<div class="modal-header">
				<h4 class="modal-title" id="buyModalLongTitle">Быстрый заказ</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" id="buyModalForm">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="buy_name">Как вас зовут</label>
								<input type="text" id="buy_name" name="name" class="form-control" placeholder="Иван Иванов">
							</div>
							<div class="form-group">
								<label for="buy_phone">Ваш телефон</label>
								<input type="tel" id="buy_phone" name="phone" pattern="\+7\s?[\(]{1}[0-9]{3}[\)]{1}\s?\d{3}[-]{1}\d{2}[-]{1}\d{2}" required class="form-control">
							</div>
							<?if ($APPLICATION->get_cookie("siteLayout") != 'mobile') {?>
						</div>
						<div class="col">
							<?}?>
							<div class="form-group">
								<label for="buy_email">Ваша почта</label>
								<input type="email" id="buy_email" name="email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" class="form-control" required placeholder="ivanov@mail.ru">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="dealerFormControlTextarea">Комментарий</label>
								<textarea id="buyFormControlTextarea" name="comment" class="form-control" rows="3" placeholder="Напишите ваше сообщение тут... "></textarea>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Отправить заказ</button>
					</div>
					<input type="hidden" name="product_id" value="">
					<input type="hidden" name="quantity" value="1">
				</form>
			</div>
		</div>
	</div>
</div>