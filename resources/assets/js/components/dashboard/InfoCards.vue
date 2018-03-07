<template>
     <div class="row">
        <kpi1 :years="years"></kpi1>
        <kpi2a :years="years"></kpi2a>
        <kpi2c :years="years"></kpi2c>
        <kpi2f :years="years"></kpi2f>
        <kpi3 :years="years"></kpi3>
     </div>
</template>

<script>
    import Kpi1 from './infoCardsContents/Kpi1';
    import Kpi2a from './infoCardsContents/Kpi2a';
    import Kpi2c from './infoCardsContents/Kpi2c';
    import Kpi2f from './infoCardsContents/Kpi2f';
    import Kpi3 from './infoCardsContents/Kpi3';

    export default {
        computed: {
            years() {
                return this.$store.getters.getTargetListYears;
            }
        },
        components:{
            Kpi1,
            Kpi2a,
            Kpi2c,
            Kpi2f,
            Kpi3,
        }
    }
</script>

<style>
    .icon-container{
        width: 200px;
        position: absolute;
        right: 1rem;
        top: 0.5rem;
    }
    .info-box-details{
        width: 70%;
    }
</style>
