<table id="indextable" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Title</th>
        <th>Start</th>
        <th>End</th>
        <th>Category</th>
        <th>Teacher</th>
        <th>Edit</th>
        <th>View</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php if(count($user->courses())>0):?>
        <?php foreach ($user->courses() as $course):?>
            <tr>
                <td><?= $course->title?></td>
                <td><?= $course->start?></td>
                <td><?= $course->end?></td>
                <td><?= $course->category()->name?></td>
                <td><?= $course->teacher()->username?></td>
                <td><a href="/courses/<?=$course->id?>/edit"><span class="fa fa-edit"></span></a></td>
                <td><a href="/courses/<?=$course->id?>"><span class="fa fa-book"></span></a></td>
                <td>
                    <?php start_form('delete',"/courses/$course->id")?>
                    <button type="submit" style="border: none;background-color: rgba(0,0,0,0); color:#9f191f">
                        <span class="fa fa-remove"></span>
                    </button>
                    <?php close_form()?>
                </td>
            </tr>
        <?php endforeach;?>
    <?php endif;?>
    </tbody>
    <tfoot>
    <tr>
        <th>Title</th>
        <th>Start</th>
        <th>End</th>
        <th>Category</th>
        <th>Teacher</th>
        <th>Edit</th>
        <th>View</th>
        <th>Delete</th>
    </tr>
    </tfoot>
</table>