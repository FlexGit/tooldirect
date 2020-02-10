<style>
	.modal-content {
		padding: 21px 25px 25px 25px;
	}
	.modal-footer {
		justify-content: center;
	}
	.modal-name {
		width: 75%;
	}
	.modal-quantity {
		width: 25%;
		text-align: center;
	}
</style>
<div class="modal" id="add2cartModal" tabindex="-1" role="dialog" aria-labelledby="add2cartModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="add2cartModalLongTitle">Товар добавлен в корзину!</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="modal-product" style="display: flex;">
					<div class="modal-name"></div>
					<div class="modal-quantity"></div>
				</div>
			</div>
			<div class="modal-footer">
				<a href="/personal/cart/" class="product__menu-button" style="width: auto;padding: 0 20px;">
					<span>Перейти в корзину</span>
				</a>
				<a href="javascript:void(0)" data-dismiss="modal" class="product__menu-button" style="width: auto;padding: 0 20px;">
					<span>Продолжить покупки</span>
				</a>
			</div>
		</div>
	</div>
</div>