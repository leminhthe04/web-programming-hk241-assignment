import { useEffect, useState } from "react";
import Promotion from "../components/Promotion";
import axios from "axios";
export default function Test() {
    const [data, setData] = useState(null);
    useEffect(() =>  {
        axios.post("http://localhost/Assignment/Backend/api/user/all")
          .then((res) => {
            console.log(res);
            setData(res.data.data);
          })
          .catch((error) => {
            if (error.response) {
              alert(error.response.data.msg);
            } else {
              console.error('Error:', error.message);
            }
          })
      }, [] )

     console.log("CHECK DATA: ", data);

    return(
        <>
        THIS IS TEST PAGE

        </>
    )

}