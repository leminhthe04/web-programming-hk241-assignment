import { Routes, Route, BrowserRouter as Router } from "react-router-dom";
import AuthProvider from "./AuthProvider";
import Login from "./pages/Login";
import ProductsManagement from "./pages/ProductsManagement";
import NewProduct from "./pages/NewProduct";
import ProductUpdate from "./pages/ProductUpdate";
import Homepage from "./pages/Homepage";
import TransactionHist from "./pages/TransactionHist";
import Shopping from "./pages/Shopping";
import Account from "./pages/Account";
import ProductDetail from "./pages/ProductDetail";
import ProductByCat from "./pages/ProductByCat";
import About from "./pages/About";
import News from "./pages/News";

import UsersManagement from "./pages/UsersManagement";
import Checkout from "./pages/Checkout";
import Dashboard from "./pages/Dashboard";

function App() {
  return (
    <Router
      future={{
        v7_startTransition: true,
        v7_relativeSplatPath: true,
      }}
    >
      <AuthProvider >
        <Routes>
          <Route path="/" element={<Login />} />

          
          <Route path="/customer/pay" element={<Checkout />} />
          <Route path="/customer/homepage" element={<Homepage />} />
          <Route path="/customer/shopping" element={<Shopping />} />
          <Route path="/customer/about" element={<About />} />
          <Route path="/customer/news" element={<News />} />
          <Route path="/customer/shopping" element={<Shopping />} />
          <Route path="/customer/category/:catName" element={<ProductByCat />} />
          <Route path="/customer/productDetail/:prodID" element={<ProductDetail />} />
          <Route path="/customer/pay/:prodID" element={<Checkout />} />
          <Route path="/customer/account/:userID" element={<Account />} />
          <Route path="/customer/history/:userID" element={<TransactionHist />} />
 
          <Route path="/admin/history/:id" element={<TransactionHist />} />
          <Route path="/admin/product-manage" element={<ProductsManagement />} />
          <Route path="/admin/product-new" element={<NewProduct />} />
          <Route path="/admin/edit-product/:id" element={<ProductUpdate />} />
  
          <Route path="/admin/user-management" element={<UsersManagement />} />

          
        </Routes>
      </AuthProvider>
    </Router>
  );
}

export default App;
