import java.util.Scanner;

/**
 * @autoher Adam
 * @version 1.8
 * @since 1.5
 */
/** Class player */
public class Player {
    Scanner scanner = new Scanner(System.in);
    public Player(String name, int bornyear, Boolean agree){
        this.name=name;
        this.bornyear=bornyear;
        this.agree=agree;
    }
    String name;
    int bornyear;
    Boolean agree;
    Boolean Created=true;
    Boolean nameerror=false;
    Boolean bornyearerror=false;
    Boolean agreeerror=false;
    /** <p> Here is the code for the functions </p> */

    public boolean createPlayer(Boolean agree, String name, int bornyear){
        System.out.println("Providing name...");
        setName(name);
        System.out.println("Providing born year...");
        setBornYear(bornyear);
        System.out.println("Checking if terms were agreeded...");
        this.agree=agree;
        if(agree==false){
            Created=false;
            agreeerror=true;
        }
        if (Created != true) {
            System.out.println("You cant access this game with options you provided:\n");
            if(nameerror==true){
                System.out.println("Your name contains special characters");
            }
            if(bornyearerror==true){
                System.out.println("You're under 18! Go back to school child");
            }
            if(agreeerror==true){
                System.out.println("You dont agree with our terms? Then dont play this game tomatohead!");
            }
            System.exit(0);
        }
        System.out.println("You created a player! Congratulation, it was really hard process.");
        return Created;
    }
    public void setName(String name){
        this.name=name;
        for(char c : name.toCharArray()){
            if(!Character.isLetterOrDigit(c)){
                Created=false;
                nameerror=true;
            }
        }
    }
    public void setBornYear(int bornyear){
        this.bornyear=bornyear;
        if(2023-bornyear<18){
            Created=false;
            bornyearerror=true;
        }
    }
}