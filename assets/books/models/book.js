
var app = app || {};

app.Book = Backbone.Model.extend({
    defaults: {
        coverImage: 'assets/books/placeholder.png',
        title: 'No title',
        author: 'Unknown',
        release_date: 'Unknown',
        keywords: 'None'
    }
});