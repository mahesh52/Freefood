<?php
include("config.php");
$val = $_GET['val'];
$type = $_GET['type'];

//echo "select * from main where name='$id'";
if (isset($_GET['type']) && $_GET['type'] != "" && $_GET['type'] == "1") {
    if (!empty($val)) {
        //echo "select a.name from area a,city b where a.guid = b.refid and  a.name='$val' order by a.name asc ";exit;
        ?>
        <select style = "width:93%;" name="state" required class="form_select">

            <option value="">Select Area</option>

            <?php $news1 = mysql_query("select a.name from area a,city b where a.refid  = b.guid and  b.name='$val' order by a.name asc ");

            while ($state = mysql_fetch_assoc($news1)) {
                ?>

                <option value="<?php echo $state['name']; ?>"><?php echo $state['name']; ?></option>

        <?php } ?>

        </select>
        <?php
    } else {
        ?><select style = "width:93%;" name="state" required class="form_select">

            <option value="">Select Area</option>


        </select>
        <?php
    }
} else {
    if (!empty($val)) {
        ?>
        <select name="area" required class="form_select">

            <option value="">Select Area</option>

        <?php $news1 = mysql_query("select * from area where refid='$val' order by name asc ");

        while ($state = mysql_fetch_assoc($news1)) {
            ?>

                <option value="<?php echo $state['guid']; ?>"><?php echo $state['name']; ?></option>

        <?php } ?>

        </select>
        <?php
    } else {
        ?><select name="area" required class="form_select">

            <option value="">Select Area</option>


        </select>
        <?php
    }
}
