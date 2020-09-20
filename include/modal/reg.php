<style>
#regModal .row {
	margin: 0 -15px;
}
#regModal .modal-footer {
	flex-direction: column;
}
#regModal a {
	color: #3CAA37;
}
#regModal a:hover {
	text-decoration: underline;
}
</style>
<div class="modal" id="regModal" tabindex="-1" role="dialog" aria-labelledby="regModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="alert alert-danger hidden" role="alert"></div>
			<div class="alert alert-success hidden" role="alert"></div>
			<div class="modal-header">
				<h4 class="modal-title" id="regModalLongTitle">Регистрация</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col">
						<form method="POST" id="regModalForm">
							<input type="hidden" name="g-recaptcha-response">
							<div class="row">
								<div class="col">
									<div class="form-group">
										<label for="reg_name">ФИО</label>
										<input type="text" id="reg_name" name="reg_name" class="form-control" required>
									</div>
									<div class="form-group">
										<label for="reg_email">E-mail</label>
										<input type="email" id="reg_email" name="reg_email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" class="form-control" required>
									</div>
									<div class="form-group">
										<label for="reg_phone">Телефон</label>
										<input type="tel" id="reg_phone" name="reg_phone" class="form-control" required>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label for="reg_phone">Пароль</label>
										<input type="password" id="reg_password" name="reg_password" class="form-control" required>
									</div>
									<div class="form-group">
										<label for="reg_phone">Пароль еще раз</label>
										<input type="password" id="reg_password_again" name="reg_password_again" class="form-control" required>
									</div>
									<div class="form-group">
										<label for="reg_city">Ваш город</label>
										<input type="text" id="reg_city" name="reg_city" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<div class="form-group form-check">
									<input type="checkbox" id="reg_consent" name="reg_consent" value="1" required class="form-check-input" checked> <label class="form-check-label" for="reg_consent">Согласие на обработку персональных данных</label>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Зарегистрироваться</button>
								</div>
								<div class="form-group">
									<a href="javascript:void(0)" id="regModalBtn" data-toggle="modal" data-target="#authModal">Уже зарегистрированы?</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>