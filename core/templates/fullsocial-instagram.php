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

  <?php $field = $fields['identifiers']; ?>
  <?php $name = $social['id'].'_'.$field['name']; ?>
  <p>
    <label for="<?php echo $this->get_field_id($name); ?>"><?php echo $field['name']; ?></label>
    <br />
    <span class="description"><?php echo $field['desc']; ?></span>
    <textarea 
      rows="5" 
      class="widefat" type="text" 
      id="<?php echo $this->get_field_id($name); ?>" 
      name="<?php echo $this->get_field_name($name); ?>" 
    ><?php echo $instance[$name]; ?></textarea>
  </p>

  <?php $field = $fields['client_id']; ?>
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

  <?php $field = $fields['count']; ?>
  <?php $name = $social['id'].'_'.$field['name']; ?>
  <p>
    <label for="<?php echo $this->get_field_id($name); ?>"><?php echo $field['name']; ?></label>
    <br />
    <span class="description"><?php echo $field['desc']; ?></span>
    <input 
      class="widefat" type="text" 
      id="<?php echo $this->get_field_id($name); ?>" 
      name="<?php echo $this->get_field_name($name); ?>" 
      value="<?php echo $instance[$name]; ?>" 
    />
  </p>
</div>
<hr />
