<div>
  <p>
    <?php $field = $fields['title']; ?>
    <?php $name = $social['id'].'_'.$field['name']; ?>
    <label> <?php echo $social['name']; ?> : </label>
      <input 
        type="text" 
        id="<?php echo $this->get_field_id($name); ?>" 
        name="<?php echo $this->get_field_name($name); ?>" 
        value="<?php echo $field['value'];?>"
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
