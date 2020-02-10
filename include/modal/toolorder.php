<div class="modal" id="toolOrderModal" tabindex="-1" role="dialog" aria-labelledby="toolOrderModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="alert alert-danger hidden" role="alert"></div>
			<div class="alert alert-success hidden" role="alert"></div>
			<div class="modal-header">
				<h4 class="modal-title" id="toolOrderModalLongTitle">не нашли нужного инструмента? закажите у нас!</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" id="toolOrderModalForm">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="tool_name">Как вас зовут</label>
								<input type="text" id="tool_name" name="name" required class="form-control" placeholder="Иван Иванов">
							</div>
							<div class="form-group">
								<label for="tool_phone">Ваш телефон</label>
								<input id="tool_phone" type="tel" name="phone" pattern="\+7\s?[\(]{1}[0-9]{3}[\)]{1}\s?\d{3}[-]{1}\d{2}[-]{1}\d{2}" required class="form-control">
							</div>
							<?if ($APPLICATION->get_cookie("siteLayout") != 'mobile') {?>
						</div>
						<div class="col">
							<?}?>
							<div class="form-group">
								<label for="tool_email">Ваш E-mail</label>
								<input type="email" id="tool_email" name="email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" class="form-control" required placeholder="ivanov@mail.ru">
							</div>
							<div class="form-group">
								<label for="tool_city">Ваш город</label>
								<input type="text" id="tool_city" name="city" required class="form-control" placeholder="Москва">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="toolOrderModalTextarea">Опишите ваши требования</label>
								<textarea id="toolOrderModalTextarea" name="comment" class="form-control" rows="3" placeholder="Напишите ваше сообщение тут... "></textarea>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Заказать инструмент</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>