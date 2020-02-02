<?php
    $title = "mainpage";
    include "templates/header.php";
    include "logic/index_logic.php";
?>

<div class="container">
    <div class="row">
        <div class="col-sm">
            <form method="post">
                
                <!-- form group -->
                <div class="col-sm text-center" style="padding-top:10px; margin:10px">
                    <?php if(!$editmode){ ?>
                        <button type="submit" class="btn btn-secondary bg-dark" name="add_btn">Add contact</button>
                    <?php } else{ ?>
                        <button type="submit" class="btn btn-light border" name="sumbit_edit_btn">Edit contact</button>
                    <?php } ?>
                        <button type="submit" class="btn btn-secondary bg-dark" name="search_btn">Search contacts</button>
                        <button type="submit" class="btn btn-secondary bg-dark mx-auto" name="show_all_btn">Show all contacts</button>
                    <div class="form-group mx-auto" style="max-width:200px; margin-top:20px">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <div style="color:red"><?php echo $errors['name_add'] ?></div>
                        <div style="color:red"><?php echo $errors['name_search'] ?></div>
                    </div>
                    <div class="form-group mx-auto" style="max-width:200px">
                        <label for="number">Phone Number</label>
                        <input type="tel" class="form-control" id="number" name="number">
                        <div style="color:red"><?php echo $errors['number_add'] ?></div>
                        <div style="color:red"><?php echo $errors['number_search'] ?></div>
                        <div style="color:red"><?php echo $errors['search'] ?></div>
                    </div>
                    <input style="display:none" readonly="readonly" type="number" class="form-control" id="hidden_id" name="hidden_id"
                     value=<?php if(isset($_POST['edit_btn'])){ echo $_POST['id']; } ?> >
                </div>
            </form>
        </div>

        <div class="col-sm">
            <table class="table table-bordered mx-auto" style="margin-top:20px; max-width:500px">
                <thead>
                    <?php if($contacts != []){ ?>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Number</th>
                    </tr>
                    <?php } ?>
                </thead>
                <tbody>
                    <?php foreach($contacts as $contact) {?>
                    <form method="post">
                        <tr>
                            <th style="display:none" scope="row"><input type="number" class="form-control table-id" readonly="readonly"
                            name="id" value="<?php echo $contact['id']; ?>">
                            </th>
                            <td><?php echo $contact['name']; ?></td>
                            <td><?php echo $contact['phone']; ?></td>
                            <td style="width:1px" class="table-del-btn"><button type="submit" class="btn btn-secondary bg-dark" name="delete_btn">Delete</button></td>
                            <td class="table-edit-btn"><button type="submit" class="btn btn-secondary bg-dark" name="edit_btn">Edit</button></td>
                        </tr>
                    </form>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php include "templates/footer.php" ?>
