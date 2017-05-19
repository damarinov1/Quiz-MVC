<div id="settings" class="tab-pane fade">
  <div class="panel panel-default">
      <div class="panel-heading">
          <h4>Settings</h4>
      </div>
      <div class="panel-body">
          <form action="?path=change-mode" method="post">
              <input type="radio" name="mode" value="tf" <?php if ($_SESSION[Session::mode] == 'tf') { echo 'checked'; } ?> />Yes/No<br>
              <input type="radio" name="mode" value="mc" <?php if ($_SESSION[Session::mode] == 'mc') { echo 'checked'; } ?>/>Multiple Choice<br>
              <input class="btn btn-primary" type="submit" value="Save changes"/>
          </form>
      </div>
  </div>
</div>
