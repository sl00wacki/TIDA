import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.*;

class PlayerTest {

    @Test
    void noSpecialCharactersTest(){
        var player = new Player("SzybkiMcqueen_", 2000, true);
        assertEquals(false, player.createPlayer(true, "SzybkiMcqueen_", 2000));

    }
    @Test
    void under18(){
        var player = new Player("SzybkiMcqueen", 2010, true);
        assertEquals(false, player.createPlayer(true, "SzybkiMcqueen", 2010));
    }
    @Test
    void noneAgree(){
        var player = new Player("SzybkiMcqueen", 2000, false);
        assertEquals(false, player.createPlayer(false, "SzybkiMcqueen", 2000));
    }
    @Test
    void everythingWorks(){
        var player = new Player("SzybkiMcqueen", 2000, true);
        assertEquals(true, player.createPlayer(true, "SzybkiMcqueen", 2000));
    }
    @Test
    void everythingDoesntWork(){
        var player = new Player("SzybkiMcqueen_", 2010, false);
        assertEquals(false, player.createPlayer(false, "SzybkiMcqueen_", 2010));
    }
}