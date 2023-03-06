<form method="post" action="">
	<div class="panel-body" style="font-family: Franklin Gothic Medium;text-transform: uppercase;color: #9f9f9f;">Настройки плагина</div>
	<div class="table-responsive">
	<table class="table table-striped">
      <tr>
        <td class="col-xs-6 col-sm-6 col-md-7">
		  <h6 class="media-heading text-semibold">Отображать дни:</h6>
		  <span class="text-muted text-size-small hidden-xs">Всегда отображать дни в профиле пользователя<br><strong>нет</strong> - то при достижении 7 месяцев в стаже дни не указываются<br><strong>да</strong> - дни всегда будут указываться </span>
		</td>
        <td class="col-xs-6 col-sm-6 col-md-5">
			<select name="us_month">{{ us_month }}</select>
        </td>
      </tr>
	
	</table>
	</div>
	<div class="panel-footer" align="center">
		<button type="submit" class="btn btn-outline-primary">Сохранить</button>
	</div>
</form>