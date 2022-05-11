<?php if(isset($formField)) { ?>
    <div class="input-container">
        <?php if($formField['type'] === "textarea") { ?>
            <textarea id="<?php echo $formField['name'] ?>" class='input text-input'
                      name="<?php echo $formField['name'] ?>" type="text" rows="<?php echo $formField['rows'] ?>"
                      <?php echo $formField['required'] ?> placeholder=" ">
            </textarea>
        <?php } else if($formField['type'] === "selector") { ?>
            <select name="<?php echo $formField['name'].'[]' ?>" id="<?php echo $formField['name'] ?>" multiple>
                <?php foreach ($formField['options'] as $option) { ?>
                    <option value="<?php echo $option['id'] ?>">
                        <?php echo $option['title'] ?>
                    </option>
                <?php } ?>
            </select>
        <?php } else { ?>
            <input id="<?php echo $formField['name'] ?>" name="<?php echo $formField['name'] ?>"
                   class="input" type="<?php echo $formField['type'] ?>" <?php echo $formField['required'] ?>
                   placeholder=" " <?php echo $formField['maxlength']? 'maxlength='.$formField['maxlength']: "" ?>
                   <?php echo $formField['minlength']? 'minlength='.$formField['minlength']: "" ?>
                   <?php echo $formField['max']? 'maxlength='.$formField['max']: "" ?>
                   <?php echo $formField['min']? 'maxlength='.$formField['min']: "" ?>/>
        <?php } ?>
        <div class="cut"></div>
        <label for="<?php echo $formField['name'] ?>" class="placeholder">
            <?php echo $formField['placeholder'] ?>
        </label>
    </div>
<?php } ?>
