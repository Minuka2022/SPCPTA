<?php

$query = "SELECT * FROM `category` WHERE `products_total` > 0 ORDER BY `category`.`category_name` ASC";
$result = mysqli_query($con, $query);

echo '<script language="JavaScript">var categories = [];</script>';

if (mysqli_num_rows($result) > 0) {
    while ($categories = mysqli_fetch_assoc($result)) {
        $category_name = $categories["category_name"];
        echo '<script language="JavaScript">categories.push("' . $category_name . '");</script>';
    }
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light mt-5 shadow p-2 mb-5 bg-body rounded" id="products-all">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold">Grade 3 </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li>
                    <form style="margin-right: 12px;">
                        <select id="year_selector" name="year" class="form-select form-select-sm"
                                aria-label=".form-select-sm example">
                            <option selected>Select Year</option>
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                            <option value="2022">2022</option>
                            <option value="2021">2021</option>
                        </select>
                    </form>
                </li>
                <li>
                    <form style="margin-right: 12px;">
                        <select id="categories_list" name="filter_by" class="form-select form-select-sm"
                                aria-label=".form-select-sm example">
                        </select>
                    </form>
                </li>
                <li>
                    <form style="margin-right: 12px;">
                        <select id="term_selector" name="term" class="form-select form-select-sm"
                                aria-label=".form-select-sm example">
                            <option selected>Select Term</option>
                            <option value="1">Term 1</option>
                            <option value="2">Term 2</option>
                            <option value="3">Term 3</option>
                        </select>
                    </form>
                </li>
                <li>
                    <form style="margin-right: 12px;">
                        <select id="medium_selector" name="medium" class="form-select form-select-sm"
                                aria-label=".form-select-sm example">
                            <option selected>Select Medium</option>
                            <option value="english">English</option>
                            <option value="french">French</option>
                            <option value="spanish">Spanish</option>
                        </select>
                    </form>
                </li>
                <li>
                    <form style="margin-right: 12px;">
                        <select id="sort_selector" name="sort_by" class="form-select form-select-sm"
                                aria-label=".form-select-sm example">
                        </select>
                    </form>
                </li>
                
                
            </ul>
        </div>
    </div>
</nav>
<script language="JavaScript">
    document.getElementById('filter-button').addEventListener('click', function () {
        // Add your filtering logic here
        alert('Filter button clicked!');
    });
</script>
