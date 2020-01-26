'use strict';

module.exports = function (grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        uglify: {
            development: {
                forceOverwrite: true,
                files: [{
                    expand: true,
                    cwd: 'js/',
                    src: ['pages/account.js','pages/calendar.js','pages/category.js','pages/dashboard.js',
                    'pages/insights.js','pages/reconciliation.js','pages/search.js','pages/settings.js',
                    'pages/transactions','accounts_selector.js','app.js','charts.js','create_transaction.js',
                    'custom-datepicker.js'],
                    dest: 'public/assets/js/'
                }]

            },
            options: {
                mangle: false,
                compress: {
                    drop_console: true
                },
            },
        },
        concat: {
            options: {
                separator: ';',
            },
            dist: {
                src: ['js/jquery.js','js/bootstrap.bundle.js',
                    'js/Chart.js','js/jquery.validate.min.js','js/jquery.easing.min.js',
                'js/bootstrap-datepicker.min.js','js/moment.min.js','js/fullcalendar.bundle.js',
                'js/jquery.dataTables.min.js','js/dataTables.bootstrap4.min.js','js/notify.min.js',
                'js/jquery-confirm.min.js','js/select2.min.js','js/sb-admin-2.min.js'],
                dest: 'public/assets/js/built.js',
            },
        },
        concat_css: {
            options: {
                // Task-specific options go here.
            },
            all: {
                src: ['css/all.min.css','css/sb-admin-2.css','css/primary.css','css/main.css',
                    'css/fullcalendar.bundle.css','css/three-dots.min.css','css/dataTables.bootstrap4.min.css',
                'css/bootstrap-datepicker.min.css','css/jquery-confirm.min.css','css/select2.min.css'],
                dest: "public/assets/css/styles.css"
            },
        },

    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-concat-css');
    grunt.registerTask('css', ['concat_css']);
    grunt.registerTask('js', ['concat','uglify']);
    grunt.registerTask('ugly',['uglify']);
    //grunt.registerTask('default', ['concat','uglify','concat_css']);

}
