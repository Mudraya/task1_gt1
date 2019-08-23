<?php
$link = mysqli_connect("localhost", "user8475", "pass847566", "test1_gt1");
$result_users = mysqli_query($link,"SELECT * FROM users");
$result_comments = mysqli_query($link,'SELECT a.id_user as user_id, a.latest_date as date, b.comment as comment FROM '.
                                                '(SELECT id_user, max(date) as latest_date FROM comments GROUP BY id_user) a '.
                                                'INNER JOIN comments b '.
                                                'ON a.id_user = b.id_user AND b.date = a.latest_date '.
                                                'ORDER BY b.id_user ');

mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
    <title>TASK1</title>
</head>
<body>

<table style="width:100%">
    <thead>
    <tr>
        <th>User Id          </th>
        <th>Full Name        </th>
        <th>Comment          </th>
        <th>Date of comment  </th>
    </tr>
    </thead>
    <?php while ($row_comm = mysqli_fetch_array($result_comments)) {
        $row = mysqli_fetch_assoc($result_users)?>
            <?php while($row_comm["user_id"] != $row["id"]) {?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td>User hasnt written any comment yet</td>
            <td>-</td>
        </tr>
            <?php $row = mysqli_fetch_assoc($result_users); } ?>
        <?php if ($row_comm["user_id"] == $row["id"]) { ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td style="white-space: pre-wrap; word-wrap: break-word"><?php echo $row_comm["comment"]; ?></td>
                <td><?php echo $row_comm["date"]; ?></td>
            </tr>
    <?php } ?>
    <?php } ?>
    <?php
    while ($row = mysqli_fetch_assoc($result_users)) { ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td>User hasnt written any comment yet</td>
            <td>-</td>
        </tr>
    <?php } ?>
</table>

</body>
</html>
