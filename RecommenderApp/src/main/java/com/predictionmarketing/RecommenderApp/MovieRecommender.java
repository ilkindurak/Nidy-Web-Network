package com.predictionmarketing.RecommenderApp;

import java.util.List;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

import org.apache.mahout.cf.taste.impl.model.jdbc.MySQLJDBCDataModel;
import org.apache.mahout.cf.taste.impl.model.jdbc.ReloadFromJDBCDataModel;
import org.apache.mahout.cf.taste.impl.neighborhood.NearestNUserNeighborhood;
import org.apache.mahout.cf.taste.impl.recommender.GenericUserBasedRecommender;
import org.apache.mahout.cf.taste.impl.similarity.PearsonCorrelationSimilarity;
import org.apache.mahout.cf.taste.impl.similarity.EuclideanDistanceSimilarity;
import org.apache.mahout.cf.taste.similarity.ItemSimilarity;
import org.apache.mahout.cf.taste.model.JDBCDataModel;
import org.apache.mahout.cf.taste.neighborhood.UserNeighborhood;
import org.apache.mahout.cf.taste.recommender.RecommendedItem;
import org.apache.mahout.cf.taste.recommender.Recommender;
import org.apache.mahout.cf.taste.similarity.UserSimilarity;

import com.mysql.jdbc.PreparedStatement;
import com.mysql.jdbc.Statement;
import com.mysql.jdbc.jdbc2.optional.MysqlDataSource;

import org.apache.mahout.cf.taste.common.TasteException;
import org.apache.mahout.cf.taste.impl.common.LongPrimitiveIterator;
import org.apache.mahout.cf.taste.impl.recommender.GenericItemBasedRecommender;

public class MovieRecommender {

	private MovieRecommender() {
	  }

	  public static void main(String[] args) throws Exception {

		  MysqlDataSource project = new MysqlDataSource ();
		  project.setServerName("localhost");
		  project.setUser("root");
		  project.setPassword("");
		  project.setDatabaseName("project") ;
		  JDBCDataModel dm = new MySQLJDBCDataModel(project,"preferences2","user_id","item_id", "rating",null);
		  ReloadFromJDBCDataModel model = new ReloadFromJDBCDataModel(dm);
		 
	    
		  UserSimilarity similarity = new PearsonCorrelationSimilarity(model);
		    
		    
		    UserNeighborhood neighborhood =
		      new NearestNUserNeighborhood(2, similarity, dm);

		    Recommender recommender = new GenericUserBasedRecommender(
		        dm, neighborhood, similarity);

		

	    Connection conn = null;
	    Statement stmt = null;
	    final String JDBC_DRIVER = "com.mysql.jdbc.Driver";
	    final String DB_URL = "jdbc:mysql://localhost:3306/project";
	    final String USER = "root";
	    final String PASS = "";
	    conn = DriverManager.getConnection(DB_URL, USER, PASS);
	    stmt = (Statement) conn.createStatement();
		  stmt.executeUpdate("DELETE FROM recommendations");
	    try {
	    Class.forName("com.mysql.jdbc.Driver");
	    } catch (ClassNotFoundException e1) {
	    e1.printStackTrace();
	    }
	    int x=1;
	    for(LongPrimitiveIterator users = dm.getUserIDs(); users.hasNext();)
	    {
	    long user_id =672;
	    System.out.println(user_id);
	    List<RecommendedItem> recommendations = recommender.recommend(user_id, 40);
	   System.out.println(recommendations);
	    for(RecommendedItem recommendation:recommendations)
	    {
	    	
	    System.out.println(user_id + "," + recommendation.getItemID() + "," + recommendation.getValue() );
	    Long user=user_id;
	    Long item=recommendation.getItemID();
	    Float rating=recommendation.getValue();
	    stmt = (Statement) conn.createStatement();
	  
	    String sql = "INSERT INTO recommendations (user_id,item_id,rating)" +"VALUES (?, ?, ?)";
	    PreparedStatement preparedStatement = null;
	    try {
	    preparedStatement = (PreparedStatement) conn.prepareStatement(sql);
	    } catch (SQLException e) {
	    e.printStackTrace();
	    }
	    preparedStatement.setLong(1,user);
	    preparedStatement.setLong(2,item);
	    preparedStatement.setFloat(3,rating);
	    preparedStatement.executeUpdate();
	    }
	    x++;
	    if(x>1000)
	    System.exit(1);
	    }
	    System.out.println("Thank you!");
	    }
	    

}
