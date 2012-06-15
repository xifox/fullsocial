<?php
/*
 * FACEBOOK backend template
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
  </p>
  <p>
    <?php $field = $fields['include_script']; ?>
    <?php $name = $social['id'].'_'.$field['name']; ?>
    <label>
      <input 
        type="checkbox" 
        id="<?php echo $this->get_field_id($name); ?>" 
        name="<?php echo $this->get_field_name($name); ?>" 
        <?php echo ($instance[$name] == 'on' ? 'checked="checked" ' : ' ') ?>
      />
      <strong>Include facebook script</strong>
    </label>
  </p>

  <?php $field = $fields['app_id']; ?>
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

  <?php $field = $fields['url_page']; ?>
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

  <?php $field = $fields['width']; ?>
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
  <?php $field = $fields['height']; ?>
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
<hr/>
