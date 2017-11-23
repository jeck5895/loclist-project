<template>

    <div class="mb-2 mt-2">
        <!-- USE SEPARATE PAGE INSTEAD  OF MODAL  -->
        <!-- <a href="#" class="btn btn-sm btn-info float-left" data-toggle="modal" data-target="#exampleModalLong">
                                <span class="fa fa-plus-circle"></span>
                                Add Client
                            </a> -->
        <router-link to="/clients/create" class="btn btn-sm btn-default">
            <span class="fa fa-plus-circle"></span>
            Add Client
        </router-link>
    </div>
</template>

<script>
    export default {

    }
</script>