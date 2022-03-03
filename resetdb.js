var fs = require('fs');
var mysql = require('mysql');
console.log(process.env.JAWSDL_URL);
var conn = mysql.createConnection(process.env.JAWSDL_URL);

conn.connect();

conn.query("drop table usuarios, proyectos, noticias, citas;", function(err, rows, fields){
  if(err) throw err;
  console.log("------------ Tables dropped ------------");
});

var sql = fs.readFileSync('init_db.sql').toString();

conn.query(sql, function(err, rows, fields){
  if(err) throw err;
  console.log("------------ Tables restored ------------");
});

conn.end();
