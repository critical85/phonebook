<?php
    $title = "mainpage";
    include "templates/header.php";
    include "logic/index_logic.php";
?>

<div class="container">
    <form method="post">
        <div class="row justify-content-around" style="margin-top:20px">

            <!-- ADD contact group -->
            <div class="col-sm text-center border" style="padding-top:10px; margin:10px">
                <button type="submit" class="btn btn-secondary bg-dark" name="add_btn">Add contact</button>
                <div class="form-group mx-auto" style="max-width:200px; margin-top:20px">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                    <div style="color:red"><?php echo $errors['name_add'] ?></div>
                </div>
                <div class="form-group mx-auto" style="max-width:200px">
                    <label for="number">Phone Number</label>
                    <input type="tel" class="form-control" id="number" name="number">
                    <div style="color:red"><?php echo $errors['number_add'] ?></div>
                </div>
            </div>

            <!-- EDIT contact group
            <div class="col-sm text-center border" style="padding-top:10px; margin:10px">
                <button type="submit" class="btn btn-secondary bg-dark" name="edit_btn">Edit contact</button>
                <div class="form-group mx-auto" style="max-width:200px; margin-top:20px">
                    <label for="name_edit">Name</label>
                    <input type="text" class="form-control" id="name_edit" name="name_edit">
                    <div style="color:red"><?php echo $errors['name_edit'] ?></div>
                </div>
                <div class="form-group mx-auto" style="max-width:200px">
                    <label for="number_edit">Phone Number</label>
                    <input type="tel" class="form-control" id="number_edit" name="number_edit">
                    <div style="color:red"><?php echo $errors['number_edit'] ?></div>
                    <div style="color:red"><?php echo $errors['edit'] ?></div>
                </div>
            </div>
             -->

            <!-- SEARCH contact group -->
            <div class="col-sm text-center border" style="padding-top:10px; margin:10px">
                <button type="submit" class="btn btn-secondary bg-dark" name="search_btn">Search contacts</button>
                <div class="form-group mx-auto" style="max-width:200px; margin-top:20px">
                    <label for="name_search">Name</label>
                    <input type="text" class="form-control" id="name_search" name="name_search">
                    <div style="color:red"><?php echo $errors['name_search'] ?></div>
                </div>
                <div class="form-group mx-auto" style="max-width:200px">
                    <label for="number_search">Phone Number</label>
                    <input type="tel" class="form-control" id="number_search" name="number_search">
                    <div style="color:red"><?php echo $errors['number_search'] ?></div>
                    <div style="color:red"><?php echo $errors['search'] ?></div>

                </div>
            </div>
        </div>

        <div class="row" style="margin-top:20px">
            <button type="submit" class="btn btn-secondary bg-dark mx-auto" name="show_all_btn">Show all contacts</button>
        </div>
    </form>

    <table class="table table-bordered mx-auto" style="margin-top:30px; max-width:500px">
        <thead>
            <tr>
                <th class="table-corner" scope="col"></th>
                <th class="table-corner" scope="col"></th>
                <th class="table-corner" scope="col"></th>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Number</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($contacts as $contact) {?>

            <form method="post">

                <tr>
                    <td><input class="test" type="text" name="name_edit"></td>
                    <td><input class="test" type="number" name="number_edit"></td>
                    <td class="table-edit-btn"><button type="submit" class="btn btn-secondary bg-dark" name="edit_btn">Edit</button></td>
                    <th scope="row"><input type="number" class="form-control table-id" readonly="readonly"
                    name="id" value="<?php echo $contact['id']; ?>">
                    </th>
                    <td><?php echo $contact['name']; ?></td>
                    <td><?php echo $contact['phone']; ?></td>
                    <td class="table-del-btn"><button type="submit" class="btn btn-secondary bg-dark" name="delete_btn">Delete</button></td>

                </tr>

            </form>

            <?php } ?>
        </tbody>
    </table>
</div>

<?php include "templates/footer.php" ?>
