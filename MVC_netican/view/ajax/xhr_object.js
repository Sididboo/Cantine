var xhr_object;
// Test pour les navigateurs Firefox, Mozilla, Opera, ...
try
{
    xhr_object = new XMLHttpRequest();
}
    catch (Error)
    {
        // Test pour Internet Explorer > 5.0
        try
        {
            xhr_object = new ActiveXObject("Msxml2.XMLHTTP");
        }
            catch (Error)
            {
                
            }
    } // Fin du 1er catch

    