<h3><?php echo __('Report a bug',array(),'email_me_fireshot') ?></h3>
<form action="<?php echo url_for('sfEmailMeAFireShot/index') ?>" method="post">
  <table>
    <?php echo $form ?>
    <tr>
      <th></th>
      <td><input type="submit" value="Send" /></td>
    </tr>
  </table>
  
  
  
</form>
