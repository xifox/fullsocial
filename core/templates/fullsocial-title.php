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
</div>
