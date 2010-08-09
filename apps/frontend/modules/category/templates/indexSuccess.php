<?php use_stylesheet('categories.css') ?>

<h1>Jobeet categories</h1>

<div id="categories">
  <table class="categories">
  <?php foreach ($categories as $i => $category): ?>
    <tr class="<?php echo fmod($i,2)?'even':'odd' ?>">
      <td class="id">
        <?php echo link_to($category->getId(),
                           'category_show', $category) ?>
      </td>
      <td class="name">
        <?php echo $category->getName() ?>
      </td>
      <td class="created_at">
        <?php echo $category->getCreatedAt() ?>
      </td>
      <td class="updated_at">
        <?php echo $category->getUpdatedAt() ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </table>
</div>

  <a href="<?php echo url_for('category/new') ?>">New</a>
