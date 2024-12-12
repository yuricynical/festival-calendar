<script type="text/javascript">
    class Helper {

        addAttributeByName(elementName, attribute, value) {
            const elements = document.getElementsByName(elementName);

            if (elements.length > 0) {
            const element = elements[0];
            element.setAttribute(attribute, value);
            } else {
            console.error("Element with the given name not found");
            }
        }

        removeAttributeByName(elementName, attribute) {
            const elements = document.getElementsByName(elementName);
            
            if (elements.length > 0) {
                elements.forEach(element => {
                    element.removeAttribute(attribute);
                });
            } else {
                console.error("No elements found with the name: " + elementName);
            }
        }
    }
</script>

<?php 
    class Scripts {
        public function setAttrName($elementName, $attribute, $value) {
            echo "
                    <script type='text/javascript'>
                        const helper = new Helper();
                        helper.addAttributeByName('$elementName', '$attribute', '$value');
                    </script>
                 ";
        }

        public function removeAttrName($elementName, $attribute) {
            echo "
                    <script type='text/javascript'>
                        const helper = new Helper();
                        helper.removeAttributeByName('$elementName', '$attribute');
                    </script>
                ";
        }   
    }
?>


