<html>
<head>
    <title>Homepage</title>
</head>

<body>

    <table width='80%' border=1>

    <tr>
        <th>Name</th> <th>Email</th> <th>date</th> <th>Subject</th>  <th>Message</th> <th>Update</th>
    </tr>
    <?php
        foreach($users as $c){
        ?>
        <tr>
          <td><?php echo $c->name ?></td>
          <td><?php echo $c->email ?></td>
          <td><?php echo $c->date ?></td>
          <td><?php echo $c->subject ?></td>
          <td><?php echo $c->message ?></td>
          <td>
                <?php echo anchor('admin/edit/'.$c->id,'Edit'); ?>
                <?php echo anchor('admin/hapus/'.$c->id,'Hapus'); ?>
          </td>
        </tr>
        <?php } ?>
    </table>
    </body>
</html>
