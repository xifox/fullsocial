<?php

/**
 * INSTAGRAM backend template
 */
?>

<div>
  <p>
    <?php $field = $fields['enabled']; ?>
    <?php $name = $social['id'].'_'.$field['name']; ?>
    <label>
      <input 
        type="checkbox" 
        id="<?php echo $this->get_field_id($name); ?>" 
        name="<?php echo $this->get_field_name($name); ?>" 
        <?php echo ($instance[$name] == 'on' ? 'checked="checked" ' : ' ') ?>
      />
      <strong><?php echo $social['name']; ?></strong>
    </label>
  <p>

  <?php $field = $fields['key']; ?>
  <?php $name = $social['id'].'_'.$field['name']; ?>
  <p>
    <label for="<?php echo $this->get_field_id($name); ?>"><?php echo $field['name']; ?></label>
    <br />
    <span class="description"><?php echo $field['desc']; ?></span>
    <input 
      type ="text"
      class="widefat" type="text" 
      id="<?php echo $this->get_field_id($name); ?>" 
      name="<?php echo $this->get_field_name($name); ?>" 
      value="<?php echo $instance[$name]; ?>" 
    />
  </p>

  <?php $field = $fields['userid']; ?>
  <?php $name = $social['id'].'_'.$field['name']; ?>
  <p>
    <label for="<?php echo $this->get_field_id($name); ?>"><?php echo $field['name']; ?></label>
    <br />
    <span class="description"><?php echo $field['desc']; ?></span>
    <input 
      type ="text"
      class="widefat" type="text" 
      id="<?php echo $this->get_field_id($name); ?>" 
      name="<?php echo $this->get_field_name($name); ?>" 
      value="<?php echo $instance[$name]; ?>" 
    />
  </p>
  <?php $field = $fields['order']; ?>
  <?php $name = $social['id'].'_'.$field['name']; ?>
  <p>
    <label for="<?php echo $this->get_field_id($name); ?>"><?php echo $field['name']; ?></label>
    <br />
    <span class="description"><?php echo $field['desc']; ?></span>
    <input 
      type ="text"
      class="widefat" type="text" 
      id="<?php echo $this->get_field_id($name); ?>" 
      name="<?php echo $this->get_field_name($name); ?>" 
      value="<?php echo $instance[$name]; ?>" 
    />
  </p>


</div>
