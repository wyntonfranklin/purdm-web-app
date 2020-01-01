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
                    src: ['tutorial_view.js','create_tutorial.js',
                        'notifications.js','rating-widget.js',
                        'starred-widget.js','admin_tasks.js','create_page.js',
                        'note_user.js', 'account_settings.js',
                        'main.js','file_manager.js','files.js','user_notifications.js',
                        'tutorial_filter.js','featured_tutorials.js'],
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
                'js/jquery-confirm.min.js','js/select2.min.js','js/sb-admin-2.min.js',
                    'js/app.js','js/charts.js','js/create_transaction.js','js/accounts_selector.js'],
                dest: 'public/assets/js/built.js',
            },
        },
        concat_css: {
            options: {
                // Task-specific options go here.
            },
            all: {
                src: ['css/boostrap.css','css/paper-kit.css','css/datables.min.css','css/jquery.contextMenu.min.css',
                    'css/jquery-confirm.min.css','css/magnific-popup.css','css/nprogress.css','css/select2.min.css',
                    'css/simplemde.min.css','css/trumbowyg.css','css/footer-distributed.css',
                    'css/jquery.datetimepicker.css','css/dropzone.css','css/main.css'],
                dest: "public/assets/css/styles.css"
            },
        },

    });

    //grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-concat');
  //  grunt.loadNpmTasks('grunt-concat-css');
   // grunt.registerTask('css', ['concat_css']);
    //grunt.registerTask('js', ['concat','uglify']);
    //grunt.registerTask('ugly',['uglify']);
    grunt.registerTask('default', ['concat']);

}
