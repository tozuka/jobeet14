<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $jobeet_category->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $jobeet_category->getName() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $jobeet_category->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $jobeet_category->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('category/edit?id='.$jobeet_category->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('category/index') ?>">List</a>
