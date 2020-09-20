<style>
#authModal .row {
	margin: 0 -15px;
}
#authModal .modal-footer {
	flex-direction: column;
}
#authModal a {
	color: #3CAA37;
}
#authModal a:hover {
	text-decoration: underline;
}
</style>
<div class="modal" id="authModal" tabindex="-1" role="dialog" aria-labelledby="authModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document" style="width: 400px;">
		<div class="modal-content">
			<div class="alert alert-danger hidden" role="alert"></div>
			<div class="alert alert-success hidden" role="alert"></div>
			<div class="modal-header">
				<h4 class="modal-title" id="authModalLongTitle">Авторизация</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col">
						<form method="POST" id="authModalForm">
							<input type="hidden" name="g-recaptcha-response">
							<div class="row">
								<div class="col">
									<div class="form-group">
										<label for="auth_login">E-mail</label>
										<input type="email" id="auth_login" name="auth_login" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" class="form-control" required>
									</div>
									<div class="form-group">
										<label for="auth_password">Пароль</label>
										<input type="password" id="auth_password" name="auth_password" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Войти</button>
								</div>
								<div class="form-group">
									<a href="#">Забыли пароль?</a>
								</div>
								<div class="form-group">
									<a href="javascript:void(0)" data-toggle="modal" data-target="#regModal">Регистрация</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>